<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Helpers\FormatHelper;
use App\Http\Controllers\Traits\FilterDataTrait;

class GuardDetailController extends Controller
{
    use FilterDataTrait;

    public function getGuardDetails($guardId, Request $request)
    {
        try {

            /* ================= BASIC GUARD ================= */

            $guard = DB::table('users')
                ->where('id', $guardId)
                ->where('isActive', 1)
                ->first();

            if (!$guard) {
                return response()->json(['success' => false], 404);
            }

            /* ================= ASSIGNMENT ================= */

            $assignment = DB::table('site_assign')
                ->where('user_id', $guardId)
                ->orderByDesc('startDate')
                ->first();

            $rangeName = $assignment?->client_name;
            $siteName  = $assignment?->site_name;
            $siteId    = $assignment?->site_id;

            if ($siteId) {
                $compartment = DB::table('site_geofences')
                    ->where('site_id', $siteId)
                    ->orderBy('id')
                    ->first();

                $compartmentName = $compartment?->name;
            }

            /* ================= DATE RANGE ================= */

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = $request->start_date;
                $endDate = $request->end_date;
            } elseif ($request->filled('start_date')) {
                $startDate = $request->start_date;
                $endDate = Carbon::now()->toDateString();
            } elseif ($request->filled('end_date')) {
                $startDate = Carbon::parse($request->end_date)->subDays(30)->toDateString();
                $endDate = $request->end_date;
            } else {
                $startDate = Carbon::now()->subDays(30)->toDateString();
                $endDate = Carbon::now()->toDateString();
            }

            $companyId = session('user')?->company_id ?? 56;

            /* ================= ATTENDANCE ================= */

            $attendanceBase = DB::table('attendance')
                ->where('user_id', $guardId)
                ->whereBetween('dateFormat', [$startDate, $endDate]);

            $presentDays = (clone $attendanceBase)
                ->distinct()
                ->count(DB::raw('DATE(dateFormat)'));

            $daysInRange = Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate)) + 1;

            $totalDays = $daysInRange;

            $absentDays = max($daysInRange - $presentDays, 0);

            $lateDays = (clone $attendanceBase)
                ->whereNotNull('lateTime')
                ->whereRaw('CAST(lateTime AS UNSIGNED) > 0')
                ->distinct()
                ->count(DB::raw('DATE(dateFormat)'));

            $attendanceRate = $daysInRange > 0
                ? round(($presentDays / $daysInRange) * 100, 1)
                : 0;

            /* ================= PATROL STATS ================= */

            $patrolBase = DB::table('patrol_sessions')
                ->where('user_id', $guardId)
                ->whereBetween('started_at', [
                    Carbon::parse($startDate)->startOfDay(),
                    Carbon::parse($endDate)->endOfDay()
                ]);

            $this->applyCanonicalFilters(
                $patrolBase,
                'patrol_sessions.started_at',
                'patrol_sessions.site_id',
                'patrol_sessions.user_id',
                true
            );

            $totalSessions = (clone $patrolBase)->count();
            $completedSessions = (clone $patrolBase)->whereNotNull('ended_at')->count();
            $ongoingSessions = $totalSessions - $completedSessions;

            $totalDistanceKm = round(
                (clone $patrolBase)->whereNotNull('ended_at')->sum('distance') / 1000,
                2
            );

            $avgDistanceKm = $completedSessions > 0
                ? round(
                    (clone $patrolBase)->whereNotNull('ended_at')->avg('distance') / 1000,
                    2
                )
                : 0;

            /* ================= INCIDENTS ================= */

            $incidentsBase = DB::table('incidence_details');

            $this->applyCanonicalFilters(
                $incidentsBase,
                'incidence_details.dateFormat',
                'incidence_details.site_id',
                'incidence_details.guard_id',
                false,
                true
            );

            $incidentsBase->where('incidence_details.company_id', $companyId)
                ->where('incidence_details.guard_id', $guardId)
                ->whereNotNull('incidence_details.type')
                ->whereNotIn('incidence_details.type', ['Other', 'other', '']);

            $totalIncidents = (clone $incidentsBase)->count();

            $incidents = (clone $incidentsBase)
                ->orderByDesc('dateFormat')
                ->limit(10)
                ->get()
                ->map(function ($i) {
                    return [
                        'id' => $i->id,
                        'type' => $i->type,
                        'priority' => $i->priority ?? 'Normal',
                        'status' => $i->status ?? 'Logged',
                        'site_name' => $i->site_name ?? 'NA',
                        'remark' => $i->remark,
                        'date' => $i->date ?? $i->dateFormat,
                        'time' => $i->time ?? null,
                    ];
                });

            /* ================= PATROL PATHS ================= */

            $patrolSessions = (clone $patrolBase)
                ->orderByDesc('started_at')
                ->get();

            $patrolPaths = $patrolSessions->map(function ($p) {

                $path = $p->path_geojson ?? null;

                if (!$path) {

                    $logs = DB::table('patrol_logs')
                        ->where('patrol_session_id', $p->id)
                        ->whereNotNull('lat')
                        ->whereNotNull('lng')
                        ->orderBy('created_at')
                        ->get(['lat', 'lng']);

                    if ($logs->count() >= 2) {
                        $path = json_encode([
                            'type' => 'LineString',
                            'coordinates' => $logs->map(fn($l) => [
                                (float)$l->lng,
                                (float)$l->lat
                            ])->toArray()
                        ]);
                    }
                }

                if (!$path && $p->start_lat && $p->start_lng && $p->end_lat && $p->end_lng) {
                    $path = json_encode([
                        'type' => 'LineString',
                        'coordinates' => [
                            [(float)$p->start_lng, (float)$p->start_lat],
                            [(float)$p->end_lng, (float)$p->end_lat],
                        ]
                    ]);
                }

                if (!$path) return null;

                return [
                    'id' => $p->id,
                    'path_geojson' => $path,
                    'started_at' => $p->started_at,
                    'ended_at' => $p->ended_at,
                    'distance' => (float)($p->distance ?? 0),
                    'session' => $p->session,
                    'type' => $p->type,
                ];
            })
                ->filter()
                ->values();

            /* ================= RESPONSE ================= */

            return response()->json([
                'success' => true,
                'guard' => [
                    'id' => $guard->id,
                    'name' => FormatHelper::formatName($guard->name),
                    'gen_id' => $guard->gen_id,
                    'designation' => $guard->designation,
                    'contact' => $guard->contact,
                    'email' => $guard->email,
                    'company_name' => $guard->company_name,
                    'range' => $rangeName,
                    'site' => $siteName,
                    'compartment' => $compartmentName,

                    'attendance_stats' => [
                        'month' => Carbon::parse($startDate)->format('M d') . ' - ' . Carbon::parse($endDate)->format('M d, Y'),
                        'total_days' => $totalDays,
                        'present_days' => $presentDays,
                        'absent_days' => $absentDays,
                        'late_days' => $lateDays,
                        'attendance_rate' => $attendanceRate,
                    ],

                    'patrol_stats' => [
                        'total_sessions' => $totalSessions,
                        'completed_sessions' => $completedSessions,
                        'ongoing_sessions' => $ongoingSessions,
                        'total_distance_km' => $totalDistanceKm,
                        'avg_distance_km' => $avgDistanceKm,
                    ],

                    'incident_stats' => [
                        'total_incidents' => $totalIncidents,
                        'latest' => $incidents,
                    ],

                    'patrol_paths' => $patrolPaths,
                ]
            ]);
        } catch (\Throwable $e) {

            Log::error('Guard Detail Error', [
                'guardId' => $guardId,
                'error' => $e->getMessage(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ], 500);
        }
    }
}

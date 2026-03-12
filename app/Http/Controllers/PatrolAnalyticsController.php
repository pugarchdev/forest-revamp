<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FilterDataTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\RoleBasedFilterService;

class PatrolAnalyticsController extends Controller
{
    use FilterDataTrait;

    public function patrolAnalytics(Request $request)
    {
        $user = session('user');
        $companyId = $user->company_id ?? 56;

        // Get users allowed by role
        $accessibleUserIds = RoleBasedFilterService::getAccessibleUserIds();

        /* ===============================
           BASE QUERY
        ================================ */
        $base = DB::table('patrol_sessions')
            ->where('patrol_sessions.company_id', $companyId)
            ->whereIn('patrol_sessions.user_id', $accessibleUserIds)
            ->join('users', 'patrol_sessions.user_id', '=', 'users.id')
            ->where('patrol_sessions.session', 'Foot')
            ->where('users.isActive', 1);

        // Apply date / site / user filters
        $this->applyCanonicalFilters(
            $base,
            'patrol_sessions.started_at',
            'patrol_sessions.site_id',
            'patrol_sessions.user_id',
            false,
            false,
            true
        );

        /* ===============================
           PER GUARD STATS
        ================================ */
        $guards = (clone $base)
            ->selectRaw('
                users.id,
                users.name as guard,
                COUNT(patrol_sessions.id) as total_sessions,
                SUM(CASE WHEN patrol_sessions.ended_at IS NOT NULL THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN patrol_sessions.ended_at IS NULL THEN 1 ELSE 0 END) as ongoing,
                ROUND(SUM(COALESCE(patrol_sessions.distance,0)),2) as total_distance,
                ROUND(AVG(COALESCE(patrol_sessions.distance,0)),2) as avg_distance
            ')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_distance')
            ->get();

        /* ===============================
           STATUS COUNTS (PIE CHART)
        ================================ */
        $status = (clone $base)
            ->selectRaw('
                SUM(CASE WHEN patrol_sessions.ended_at IS NOT NULL THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN patrol_sessions.ended_at IS NULL THEN 1 ELSE 0 END) as ongoing,
                SUM(
                    CASE
                        WHEN patrol_sessions.ended_at IS NOT NULL
                        AND (patrol_sessions.distance IS NULL OR patrol_sessions.distance = 0)
                    THEN 1 ELSE 0 END
                ) as incomplete
            ')
            ->first();

        /* ===============================
           KPI STATS
        ================================ */
        $statsQuery = (clone $base)
            ->selectRaw('
                COUNT(*) as total_sessions,
                SUM(CASE WHEN patrol_sessions.ended_at IS NOT NULL THEN 1 ELSE 0 END) as completed_sessions,
                SUM(CASE WHEN patrol_sessions.ended_at IS NULL THEN 1 ELSE 0 END) as active_sessions,
                ROUND(SUM(COALESCE(patrol_sessions.distance,0)) / 1000, 2) as total_distance_km
            ')
            ->first();

        $stats = [
            'total_sessions' => (int) ($statsQuery->total_sessions ?? 0),
            'completed_sessions' => (int) ($statsQuery->completed_sessions ?? 0),
            'active_sessions' => (int) ($statsQuery->active_sessions ?? 0),
            'total_distance_km' => (float) ($statsQuery->total_distance_km ?? 0)
        ];

        // Completion rate KPI
        $stats['completion_rate'] =
            $stats['total_sessions'] > 0
            ? round(($stats['completed_sessions'] / $stats['total_sessions']) * 100, 2)
            : 0;

        /* ===============================
           HOURLY PATROL ACTIVITY
        ================================ */
        $hourly = (clone $base)
            ->selectRaw('HOUR(patrol_sessions.started_at) as hour, COUNT(*) as total')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        /* ===============================
           FILTER DATA
        ================================ */
        $filterData = $this->filterData();

        return view('patrol.analytics', array_merge(
            $filterData,
            compact('guards', 'status', 'stats', 'hourly')
        ));
    }
}

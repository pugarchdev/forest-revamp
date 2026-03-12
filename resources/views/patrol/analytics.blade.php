@extends('layouts.app')

@section('content')


{{-- Title --}}
<div class="mb-3">
    <h4 class="fw-bold mb-3">Patrol Analysis</h4>
</div>

{{-- KPI Cards --}}
@include('partials.patrol-kpis', ['stats' => $stats])

{{-- Guard Stats Table --}}
@if(isset($guards) && $guards->count() > 0)
<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-primary text-white">
        <h6 class="mb-0">Guard Performance</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Guard Name</th>
                        <th class="text-end">Total Sessions</th>
                        <th class="text-end">Completed</th>
                        <th class="text-end">Ongoing</th>
                        <th class="text-end">Total Distance (m)</th>
                        <th class="text-end">Avg Distance (m)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($guards as $guard)
                    <tr>
                        <td>
                            <a href="javascript:void(0)"
                                class="guard-name-link fw-bold text-decoration-none"
                                data-guard-id="{{ $guard->id }}">
                                {{ $guard->guard }}
                            </a>
                        </td>
                        <td class="text-end">{{ $guard->total_sessions }}</td>
                        <td class="text-end text-success">{{ $guard->completed }}</td>
                        <td class="text-end text-warning">{{ $guard->ongoing }}</td>
                        <td class="text-end">{{ number_format($guard->total_distance, 2) }}</td>
                        <td class="text-end">{{ number_format($guard->avg_distance, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
<div class="alert alert-info mt-4">
    <i class="bi bi-info-circle"></i> No patrol data found for the selected filters.
</div>
@endif

@endsection
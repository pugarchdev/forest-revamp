<div class="sidebar" id="sidebar">

    {{-- Sidebar Logo Area --}}
    <div class="sidebar-logo text-center py-4 border-bottom border-secondary mt-3">

        <img src="{{ asset('images/logo1.png') }}"
            alt="Logo"
            class="img-fluid d-block mx-auto mb-2"
            style="max-height:60px;">

        <h6 class="text-white fw-bold mb-0">
            AI Patrolling
        </h6>

    </div>

    <div class="sidebar-content py-2">

        {{-- MAIN DASHBOARD --}}
        {{-- <a href="/forest-dashboard"
           class="sidebar-link {{ request()->routeIs('/') || request()->is('/') ? 'active' : '' }}"
        title="Main Dashboard">
        <i class="bi bi-speedometer2 fs-5 me-2"></i>
        <span class="link-text">Main Dashboard</span>
        </a> --}}

        <a href="/home"
            class="sidebar-link {{ request()->is('home') ? 'active' : '' }}"
            title="Old Dashboard">
            <i class="bi bi-archive fs-5 me-2"></i>
            <span class="link-text">Dashboard</span>
        </a>

        <a href="/analytics/executive"
            class="sidebar-link {{ request()->is('analytics/executive') ? 'active' : '' }}"
            title="Executive Analytics">
            <i class="bi bi-graph-up-arrow fs-5 me-2"></i>
            <span class="link-text">Executive Analytics</span>
        </a>

        <hr class="sidebar-divider my-2 text-white">

        {{-- 1. Foot Patrolling --}}
        <a href="/patrol/foot-summary"
            class="sidebar-link {{ request()->is('patrol/foot-summary') ? 'active' : '' }}"
            title="Foot Patrolling">
            <i class="bi bi-person-walking fs-5 me-2"></i>
            <span class="link-text">Foot Patrolling</span>
        </a>

        {{-- 2. Night Patrolling --}}
        <a href="/patrol/night-summary"
            class="sidebar-link {{ request()->is('patrol/night-summary') ? 'active' : '' }}"
            title="Night Patrolling">
            <i class="bi bi-moon-stars fs-5 me-2"></i>
            <span class="link-text">Night Patrolling</span>
        </a>

        {{-- 3. KML/Patrol Map --}}
        <a href="/patrol/maps"
            class="sidebar-link {{ request()->is('patrol/maps') ? 'active' : '' }}"
            title="KML/Patrol Map">
            <i class="bi bi-map fs-5 me-2"></i>
            <span class="link-text">KML/Patrol Map</span>
        </a>

        {{-- 4. Attendance Summary --}}
        <a href="/attendance/summary"
            class="sidebar-link {{ request()->is('attendance/summary') ? 'active' : '' }}"
            title="Attendance Summary">
            <i class="bi bi-calendar-check fs-5 me-2"></i>
            <span class="link-text">Attendance Summary</span>
        </a>

        {{-- 5. Incident Summary --}}
        <a href="/incidents/summary"
            class="sidebar-link {{ request()->is('incidents/summary') ? 'active' : '' }}"
            title="Incident Summary">
            <i class="bi bi-exclamation-triangle fs-5 me-2"></i>
            <span class="link-text">Incident Summary</span>
        </a>

        {{-- 6. Reports --}}
        <a href="/reports/monthly"
            class="sidebar-link {{ request()->is('reports/monthly') ? 'active' : '' }}"
            title="Reports">
            <i class="bi bi-file-earmark-text fs-5 me-2"></i>
            <span class="link-text">Reports</span>
        </a>

        {{-- 7. Camera & Tracking --}}
        <a href="/reports/camera-tracking"
            class="sidebar-link {{ request()->is('reports/camera-tracking') ? 'active' : '' }}"
            title="Camera & Tracking">
            <i class="bi bi-camera-video fs-5 me-2"></i>
            <span class="link-text">Camera & Tracking</span>
        </a>
        @if(auth()->user()->role_id == 1)
        
        <a href="{{ route('sites.index') }}"
            class="sidebar-link {{ request()->is('sites*') || request()->is('clients/*/sites') ? 'active' : '' }}">

            <i class="bi bi-building"></i>
            <span class="link-text">Sites</span>

        </a>

        @endif

        {{-- Plantation Management Module --}}
        @if(auth()->user()->role_id == 1)
        <hr class="sidebar-divider my-2 text-white">

        <div class="px-3 text-uppercase small text-white-50 mb-1">
            Plantation Management
        </div>

        {{-- Plantation Dashboard --}}
        <a href="/plantation/dashboard"
            class="sidebar-link {{ request()->is('plantation/dashboard') ? 'active' : '' }}"
            title="Plantation Dashboard">
            <i class="bi bi-tree fs-5 me-2"></i>
            <span class="link-text">Plantation Dashboard</span>
        </a>

        {{-- Grid Management --}}
        <a href="/plantation/grids"
            class="sidebar-link {{ request()->is('plantation/grids') ? 'active' : '' }}"
            title="Grid Management">
            <i class="bi bi-grid-3x3-gap fs-5 me-2"></i>
            <span class="link-text">Grid Management</span>
        </a>

        {{-- User Roles --}}
        <a href="/plantation/users"
            class="sidebar-link {{ request()->is('plantation/users') ? 'active' : '' }}"
            title="User Roles">
            <i class="bi bi-people fs-5 me-2"></i>
            <span class="link-text">User Roles</span>
        </a>

        {{-- Survival Analytics --}}
        <a href="/plantation/analytics"
            class="sidebar-link {{ request()->is('plantation/analytics') ? 'active' : '' }}"
            title="Survival Analytics">
            <i class="bi bi-bar-chart-line fs-5 me-2"></i>
            <span class="link-text">Survival Analytics</span>
        </a>
        @endif


        {{-- CLIENT MANAGEMENT --}}
        <hr class="sidebar-divider my-2 text-white">

        <div class="px-3 text-uppercase small text-white-50 mb-1">
            Client Management
        </div>

        @if(auth()->user()->role_id == 1)

        <a href="{{ route('clients.index') }}"
            class="sidebar-link {{ request()->is('clients*') ? 'active' : '' }}"
            title="Clients">

            <i class="bi bi-building fs-5 me-2"></i>
            <span class="link-text">Clients</span>

        </a>

        @endif
    </div>
</div>

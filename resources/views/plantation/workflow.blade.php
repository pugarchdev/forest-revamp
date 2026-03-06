@extends('layouts.app')

@section('title','Plantation Workflow')

@section('content')

<!-- <div class="max-w-7xl mx-auto">
<a href="/plantation/dashboard"
   class="inline-flex items-center gap-2 px-4 py-2 mb-6
   text-sm font-medium !bg-red-600 !text-white rounded-lg
   hover:!text-gray-700
   !no-underline hover:!no-underline">
   ← Back to Dashboard
</a>




    <div class="bg-gray-100 p-6 rounded-xl shadow-sm border border-slate-200 mb-6 flex justify-between items-start">

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                {{ $plantation->name ?? $plantation->code }}
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Code : {{ $plantation->code }} |
                Grid : {{ $plantation->grid_id }}
            </p>
        </div>

        <div class="text-right">
            <div class="text-xs text-slate-400 uppercase mb-10">
                System Status
            </div>

            <span class="px-3 py-1 rounded-full text-sm font-semibold bg-emerald-100 text-emerald-700">
                Strict Sequential Flow
            </span>
        </div>

    </div>




    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 mb-6 overflow-x-auto">

        <ol class="flex items-center w-full min-w-[600px] list-none">

            @php
            $currentIndex = array_search($plantation->current_phase,$phases);
            @endphp

            @foreach($phases as $phase)

            @php $i = $loop->index; @endphp

            <li class="flex w-full items-center text-sm font-medium">

                <div class="flex items-center justify-center w-8 h-8 rounded-full border-2 @if($i < $currentIndex) bg-green-600 border-green-600 text-white @elseif($i == $currentIndex) border-green-600 text-green-600 @else border-slate-200 text-slate-400 @endif">

                    @if($i < $currentIndex)
                        ✓
                        @else
                        {{ $i+1 }}
                        @endif

                        </div>

                        <span class="ml-3 capitalize @if($i == $currentIndex) font-bold text-green-600 @endif">
                            {{ $phase }}
                        </span>

                        @if(!$loop->last)
                        <div class="flex-auto border-t-2 mx-4 @if($i < $currentIndex) border-green-600 @else border-slate-200 @endif"></div>
                        @endif

            </li>

            @endforeach

        </ol>

    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">



        <div class="lg:col-span-2">

            <div class="bg-white rounded-xl shadow-sm border border-slate-200">

                <div class="bg-slate-50 p-4 border-b border-slate-200">

                    <h3 class="font-bold capitalize">
                        Active Phase : {{ $plantation->current_phase }}
                    </h3>

                </div>


                <div class="p-6">

                    <form method="POST" action="/plantation/workflow/{{ $plantation->id }}">
                        @csrf


                        @if($plantation->current_phase=='identification')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Land Owner Name</label>
                                <input type="text" name="land_owner_name"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Land Type</label>
                                <select name="land_type"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">

                                    <option value="govt">Government</option>
                                    <option value="private">Private</option>
                                    <option value="community">Community</option>

                                </select>
                            </div>

                        </div>

                        @endif



                        @if($plantation->current_phase=='measurement')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Total Area (sq m)</label>
                                <input type="number" name="area"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Soil Type</label>
                                <input type="text" name="soil_type"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                        </div>

                        @endif



                        @if($plantation->current_phase=='planning')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Plant Species</label>
                                <input type="text" name="plant_species"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Plant Count</label>
                                <input type="number" name="plant_count"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                        </div>

                        @endif



                        @if($plantation->current_phase=='planting')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Planting Date</label>
                                <input type="date" name="planting_date"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Team Size</label>
                                <input type="number" name="team_size"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                        </div>

                        @endif



                        @if($plantation->current_phase=='fencing')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Fence Type</label>
                                <input type="text" name="fence_type"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Boundary Length</label>
                                <input type="number" name="boundary_length"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                        </div>

                        @endif



                        @if($plantation->current_phase=='observation')

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="text-sm font-medium">Survival Count</label>
                                <input type="number" name="survival_count"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                            <div>
                                <label class="text-sm font-medium">Avg Height</label>
                                <input type="number" name="avg_height"
                                    class="w-full border border-slate-300 rounded-lg p-2 mt-1">
                            </div>

                        </div>

                        @endif



                        <div class="mt-8 flex justify-end pt-4 border-t">

                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">

                                Save & Advance Phase →

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>





        <div class="space-y-6">

            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200">

                <h3 class="font-bold mb-4">
                    Audit Trail
                </h3>

                <p class="text-sm text-slate-500">
                    No actions recorded yet.
                </p>

            </div>


            <div class="bg-blue-50 p-5 rounded-xl border border-blue-100">

                <h3 class="font-bold text-blue-900 mb-2">
                    Workflow Rules
                </h3>

                <ul class="text-sm text-blue-800 space-y-2 list-disc pl-4">

                    <li>Phases cannot be skipped</li>
                    <li>Completed phase data is read-only</li>
                    <li>Relocation restarts workflow</li>

                </ul>

            </div>

        </div>

    </div>

</div> -->


<div class="container mt-4">

    <!-- BACK BUTTON -->

    <a href="/plantation/dashboard" class="btn btn-danger mb-4">
        ← Back to Dashboard
    </a>

    <!-- HEADER -->

    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-start">

            <div>
                <h4 class="fw-bold">
                    {{ $plantation->name ?? $plantation->code }}
                </h4>

                <p class="text-muted small">
                    Code : {{ $plantation->code }} |
                    Grid : {{ $plantation->grid_id }}
                </p>
            </div>

            <div class="text-end">
                <div class="text-uppercase small text-muted mb-2">
                    System Status
                </div>

                <span class="badge bg-success">
                    Strict Sequential Flow
                </span>
            </div>

        </div>
    </div>

    <!-- STEPPER -->

    <div class="card mb-4">
        <div class="card-body">

            @php
            $currentIndex = array_search($plantation->current_phase,$phases);
            @endphp

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                @foreach($phases as $phase)

                @php $i = $loop->index; @endphp

                <div class="text-center flex-fill">

                    @if($i < $currentIndex)

                        <span class="badge bg-success rounded-circle p-3">✓</span>

                        @elseif($i == $currentIndex)

                        <span class="badge bg-success rounded-circle p-3">
                            {{ $i+1 }}
                        </span>

                        @else

                        <span class="badge bg-secondary rounded-circle p-3">
                            {{ $i+1 }}
                        </span>

                        @endif

                        <div class="mt-2 @if($i == $currentIndex) fw-bold text-success @endif">
                            {{ ucfirst($phase) }}
                        </div>

                </div>

                @endforeach

            </div>

        </div>
    </div>

    <!-- CONTENT GRID -->

    <div class="row">

        <!-- LEFT FORM -->

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header fw-bold">
                    Active Phase : {{ $plantation->current_phase }}
                </div>

                <div class="card-body">

                    <form method="POST" action="/plantation/workflow/{{ $plantation->id }}">
                        @csrf

                        @if($plantation->current_phase=='identification')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Land Owner Name</label>
                                <input type="text" name="land_owner_name" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Land Type</label>
                                <select name="land_type" class="form-select">

                                    <option value="govt">Government</option>
                                    <option value="private">Private</option>
                                    <option value="community">Community</option>

                                </select>
                            </div>

                        </div>

                        @endif

                        @if($plantation->current_phase=='measurement')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Total Area (sq m)</label>
                                <input type="number" name="area" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Soil Type</label>
                                <input type="text" name="soil_type" class="form-control">
                            </div>

                        </div>

                        @endif

                        @if($plantation->current_phase=='planning')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Plant Species</label>
                                <input type="text" name="plant_species" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Plant Count</label>
                                <input type="number" name="plant_count" class="form-control">
                            </div>

                        </div>

                        @endif

                        @if($plantation->current_phase=='planting')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Planting Date</label>
                                <input type="date" name="planting_date" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Team Size</label>
                                <input type="number" name="team_size" class="form-control">
                            </div>

                        </div>

                        @endif

                        @if($plantation->current_phase=='fencing')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Fence Type</label>
                                <input type="text" name="fence_type" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Boundary Length</label>
                                <input type="number" name="boundary_length" class="form-control">
                            </div>

                        </div>

                        @endif

                        @if($plantation->current_phase=='observation')

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Survival Count</label>
                                <input type="number" name="survival_count" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Avg Height</label>
                                <input type="number" name="avg_height" class="form-control">
                            </div>

                        </div>

                        @endif

                        <div class="text-end">

                            <button type="submit" class="btn btn-success">
                                Save & Advance Phase →
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- RIGHT PANEL -->

        <div class="col-lg-4">

            <div class="card mb-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Audit Trail
                    </h5>

                    <p class="text-muted small">
                        No actions recorded yet.
                    </p>

                </div>

            </div>

            <div class="card border-primary">

                <div class="card-body bg-light">

                    <h5 class="fw-bold text-primary mb-3">
                        Workflow Rules
                    </h5>

                    <ul class="small">

                        <li>Phases cannot be skipped</li>
                        <li>Completed phase data is read-only</li>
                        <li>Relocation restarts workflow</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
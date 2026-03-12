@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h5>Edit Employee Assignment</h5>
        </div>

        <div class="card-body">

            <form method="POST"
                action="{{ route('site.employees.update', [$site->id, $assignment->id]) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label>Employee</label>

                        <select name="user_id" class="form-control">

                            @foreach($employees as $emp)

                            <option value="{{ $emp->id }}"
                                {{ $assignment->user_id == $emp->id ? 'selected' : '' }}>

                                {{ $emp->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Shift</label>

                        <select name="shift_id" class="form-control">

                            @foreach($shifts as $shift)

                            <option value="{{ $shift->id }}"
                                {{ $assignment->shift_id == $shift->id ? 'selected' : '' }}>

                                {{ $shift->shift_name }} ({{ $shift->shift_time }})

                            </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>Start Date</label>

                        <input type="date"
                            name="start_date"
                            class="form-control"
                            value="{{ $assignment->startDate }}">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label>End Date</label>

                        <input type="date"
                            name="end_date"
                            class="form-control"
                            value="{{ $assignment->endDate }}">

                    </div>

                    <div class="col-md-12 mb-3">

                        <label>Week Off</label>

                        @php
                        $weekoffs = explode(',', $assignment->weekoff);
                        @endphp

                        <div class="d-flex flex-wrap gap-3 mt-2">

                            @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)

                            <label>

                                <input type="checkbox"
                                    name="weekoff[]"
                                    value="{{ $day }}"
                                    {{ in_array($day, $weekoffs) ? 'checked' : '' }}>

                                {{ $day }}

                            </label>

                            @endforeach

                        </div>

                    </div>

                </div>

                <button class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('site.employees', $site->id) }}"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

@endsection

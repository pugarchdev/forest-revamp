@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h4>Assign Employees</h4>

        </div>


        <div class="card-body">

            <form method="POST"
                action="{{ route('site.employees.store',$site->id) }}">

                @csrf

                <input type="hidden" name="site_name" value="{{ $site->name }}">


                <div class="row">

                    <div class="col-md-6">

                        <label>Shifts</label>

                        <select name="shift_id" class="form-control">

                            <option value="">Select Shift</option>

                            @foreach($shifts as $shift)

                            <option value="{{ $shift->id }}">

                                {{ $shift->shift_name }} ({{ $shift->shift_time }})

                            </option>

                            @endforeach

                        </select>

                    </div>



                    <div class="col-md-6">

                        <label>Employees</label>

                        <select name="user_id" class="form-control">

                            <option value="">Select Employee</option>

                            @foreach($employees as $emp)

                            <option value="{{ $emp->id }}">

                                {{ $emp->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mt-3">

                        <label>Start Date</label>

                        <input type="date" name="start_date"
                            class="form-control">

                    </div>


                    <div class="col-md-6 mt-3">

                        <label>End Date</label>

                        <input type="date" name="end_date"
                            class="form-control">

                    </div>


                    <div class="col-md-12 mt-3">

                        <label>Week Offs</label>

                        <br>

                        @foreach(['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'] as $day)

                        <label class="me-3">

                            <input type="checkbox" name="weekoff[]"
                                value="{{ $day }}">

                            {{ $day }}

                        </label>

                        @endforeach

                    </div>

                </div>


                <br>

                <a href="{{ route('site.employees',$site->id) }}"
                    class="btn btn-secondary">

                    Back

                </a>

                <button class="btn btn-success">

                    Save

                </button>

            </form>

        </div>

    </div>

</div>

@endsection

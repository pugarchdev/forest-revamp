@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h5>Employee Details</h5>

            <a href="#" class="btn btn-warning">
                Edit Profile
            </a>

        </div>

        <div class="card-body">

            <div class="row">

                {{-- LEFT PROFILE --}}
                <div class="col-md-4 text-center">

                    <img src="{{ asset('images/user.png') }}"
                        class="rounded-circle mb-3"
                        width="120">

                    <h4>{{ $assignment->user->name }}</h4>

                    <p>{{ $assignment->user->gen_id }}</p>

                </div>


                {{-- RIGHT DETAILS --}}
                <div class="col-md-8">

                    <h6>PERSONAL INFORMATION</h6>

                    <div class="row">

                        <div class="col-md-6">
                            Phone Number
                            <p>{{ $assignment->user->contact }}</p>
                        </div>

                        <div class="col-md-6">
                            Email
                            <p>{{ $assignment->user->email ?? 'N/A' }}</p>
                        </div>

                        <div class="col-md-6">
                            Gender
                            <p>{{ $assignment->user->gender ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            Date of Birth
                            <p>{{ $assignment->user->dob ?? '-' }}</p>
                        </div>

                        <div class="col-md-12">
                            Address
                            <p>{{ $assignment->user->address ?? '-' }}</p>
                        </div>

                    </div>

                    <hr>

                    <h6>CURRENT ASSIGNMENT</h6>

                    <div class="row">

                        <div class="col-md-6">
                            Assigned Site
                            <p>{{ $assignment->site->name ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            Shift Name
                            <p>{{ $assignment->shift_name ?? '-' }}</p>
                        </div>

                        <div class="col-md-6">
                            Shift Duration
                            <p>
                                {{ $assignment->shift_start }}
                                -
                                {{ $assignment->shift_end }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            Assignment Period
                            <p>
                                {{ $assignment->startDate }}
                                to
                                {{ $assignment->endDate }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            Week Off
                            <p>{{ $assignment->weekoff ?? '-' }}</p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

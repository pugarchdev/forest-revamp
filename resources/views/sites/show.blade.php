@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                <i class="bi bi-building text-primary"></i>
                {{ $site->name }} - Site Details
            </h4>

            <a href="{{ route('sites.index') }}" class="btn btn-light border">
                <i class="bi bi-arrow-left"></i> Back
            </a>

        </div>


        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Client Name</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-person"></i> {{ $site->client_name }}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Contact Person</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-person-badge"></i> {{ $site->contactPerson }}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Mobile Number</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-telephone"></i> {{ $site->mobile }}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Email Address</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-envelope"></i> {{ $site->email ?? '-' }}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">City</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-geo-alt"></i> {{ $site->city }}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Pincode</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-pin-map"></i> {{ $site->pincode }}
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="border rounded p-3 bg-light">
                        <label class="text-muted small">Address</label>
                        <div class="fw-semibold fs-6">
                            <i class="bi bi-geo"></i> {{ $site->address }}
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h5 class="mb-0">Edit Site</h5>
        </div>

        <div class="card-body">

            <form action="{{ route('sites.update',$site->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Client*</label>

                        <select name="client_id" class="form-control">

                            <option value="">Select client</option>

                            @foreach($clients as $id => $name)
                            <option value="{{ $id }}"
                                {{ $site->client_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Site Name*</label>
                        <input type="text" name="site_name" class="form-control"
                            value="{{ $site->name }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Site Address*</label>
                        <input type="text" name="site_address" class="form-control"
                            value="{{ $site->address }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">State*</label>
                        <input type="text" name="state" class="form-control"
                            value="{{ $site->state }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">City*</label>
                        <input type="text" name="city" class="form-control"
                            value="{{ $site->city }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pincode*</label>
                        <input type="text" name="pincode" class="form-control"
                            value="{{ $site->pincode }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact person name*</label>
                        <input type="text" name="contact_person_name" class="form-control"
                            value="{{ $site->contactPerson }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Contact person number*</label>
                        <input type="text" name="contact_person_number" class="form-control"
                            value="{{ $site->mobile }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email*</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ $site->email }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">SOS number*</label>
                        <input type="text" name="sos_number" class="form-control"
                            value="{{ $site->sosContact }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Early cut-off*</label>
                        <input type="time" name="early_cutoff" class="form-control"
                            value="{{ $site->earlyTime }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Late cut-off*</label>
                        <input type="time" name="late_cutoff" class="form-control"
                            value="{{ $site->lateTime }}">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label class="form-label">Site type*</label>

                        <select name="site_type" class="form-control">

                            <option value="">Select site type</option>

                            <option value="Office" {{ $site->siteType == 'Office' ? 'selected' : '' }}>
                                Office
                            </option>

                            <option value="Factory" {{ $site->siteType == 'Factory' ? 'selected' : '' }}>
                                Factory
                            </option>

                            <option value="Warehouse" {{ $site->siteType == 'Warehouse' ? 'selected' : '' }}>
                                Warehouse
                            </option>

                        </select>

                    </div>

                </div>


                <div class="mt-3">

                    <a href="{{ route('sites.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                    <button class="btn btn-success">
                        Update Site
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

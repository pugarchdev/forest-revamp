@extends('layouts.app')

@section('title','Add Client')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Add Client</h5>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('clients.store') }}">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name*</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Address*</label>
                    <input type="text" name="address" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>State*</label>
                    <input type="text" name="state" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>City*</label>
                    <input type="text" name="city" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Pincode*</label>
                    <input type="text" name="pincode" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Contact Person Name*</label>
                    <input type="text" name="spokesperson" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Contact Person Number*</label>
                    <input type="text" name="contact" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Company Email*</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Relationship Manager*</label>
                    <input type="text" name="relationManager" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Relationship Manager Contact*</label>
                    <input type="text" name="relationManagerContact" class="form-control">
                </div>

            </div>

            <button class="btn btn-primary">Create Client</button>

            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
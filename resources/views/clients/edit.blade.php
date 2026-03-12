@extends('layouts.app')

@section('title','Edit Client')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Edit Client</h5>
    </div>

    <div class="card-body">

        <form method="POST" action="{{ route('clients.update',$client->id) }}">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name*</label>
                    <input type="text" name="name" value="{{ $client->name }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Address*</label>
                    <input type="text" name="address" value="{{ $client->address }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>State*</label>
                    <input type="text" name="state" value="{{ $client->state }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>City*</label>
                    <input type="text" name="city" value="{{ $client->city }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Pincode*</label>
                    <input type="text" name="pincode" value="{{ $client->pincode }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Contact Person Name*</label>
                    <input type="text" name="spokesperson" value="{{ $client->spokesperson }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Contact Person Number*</label>
                    <input type="text" name="contact" value="{{ $client->contact }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Company Email*</label>
                    <input type="email" name="email" value="{{ $client->email }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Relationship Manager*</label>
                    <input type="text" name="relationManager" value="{{ $client->relationManager }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Relationship Manager Contact*</label>
                    <input type="text" name="relationManagerContact" value="{{ $client->relationManagerContact }}" class="form-control">
                </div>

            </div>

            <button class="btn btn-primary">Update Client</button>

            <a href="{{ route('clients.index') }}" class="btn btn-secondary">
                Cancel
            </a>

        </form>

    </div>

</div>

@endsection
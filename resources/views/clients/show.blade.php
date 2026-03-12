@extends('layouts.app')

@section('title','Client Details')

@section('content')

<div class="card">

    <div class="card-header">
        <h5>Client Details</h5>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Name</th>
                <td>{{ $client->name }}</td>
            </tr>

            <tr>
                <th>Email</th>
                <td>{{ $client->email }}</td>
            </tr>

            <tr>
                <th>Contact</th>
                <td>{{ $client->contact }}</td>
            </tr>

            <tr>
                <th>Address</th>
                <td>{{ $client->address }}</td>
            </tr>

            <tr>
                <th>State</th>
                <td>{{ $client->state }}</td>
            </tr>

            <tr>
                <th>City</th>
                <td>{{ $client->city }}</td>
            </tr>

            <tr>
                <th>Pincode</th>
                <td>{{ $client->pincode }}</td>
            </tr>

            <tr>
                <th>Relationship Manager</th>
                <td>{{ $client->relationManager }}</td>
            </tr>

        </table>

        <a href="{{ route('clients.index') }}" class="btn btn-primary">
            Back
        </a>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Site List</h5>

            <div>

                <a href="{{ route('sites.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Site
                </a>

                <button class="btn btn-primary">
                    <i class="bi bi-download"></i> Export
                </button>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>
                        <th>SR. NO.</th>
                        <th>SITE NAME</th>
                        <th>CLIENT NAME</th>
                        <th>MANAGEMENT</th>
                        <th>ACTION</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($sites as $site)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td class="text-primary">
                            {{ $site->name }}
                        </td>

                        <td>
                            {{ $site->client_name }}
                        </td>

                        <td>

                            <span class="badge bg-light text-primary border">SHIFTS</span>
                            <span class="badge bg-light text-primary border">GEOFENCE</span>
                            <span class="badge bg-light text-primary border">EMPLOYEE</span>
                            <span class="badge bg-light text-primary border">TOUR</span>

                        </td>

                        <td>

                            <a href="#" class="btn btn-sm btn-light">
                                <i class="bi bi-eye text-primary"></i>
                            </a>

                            <a href="#" class="btn btn-sm btn-light">
                                <i class="bi bi-pencil text-success"></i>
                            </a>

                            <a href="#" class="btn btn-sm btn-light">
                                <i class="bi bi-trash text-danger"></i>
                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
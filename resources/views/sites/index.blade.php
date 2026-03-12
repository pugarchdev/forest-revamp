@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            @if(isset($client))
            <h5 class="mb-3">
                Sites for Client: {{ $client->name }}
            </h5>
            @endif
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

                            <a href="{{ route('shifts.index', $site->id) }}"
                                class="badge bg-light text-primary border text-decoration-none">
                                SHIFTS
                            </a>

                            <a href="#"
                                class="badge bg-light text-primary border text-decoration-none">
                                GEOFENCE
                            </a>

                            <a href="{{ route('site.employees', $site->id) }}"
                                class="badge bg-light text-primary border text-decoration-none">
                                EMPLOYEE
                            </a>

                            <!-- <a href="#"
                                class="badge bg-light text-primary border text-decoration-none">
                                TOUR
                            </a> -->

                        </td>

                        <td>

                            <a href="{{ route('sites.show', $site->id) }}" class="btn btn-sm btn-light">
                                <i class="bi bi-eye text-primary"></i>
                            </a>
                            <a href="{{ route('sites.edit', $site->id) }}" class="btn btn-sm btn-light">
                                <i class="bi bi-pencil text-success"></i>
                            </a>
                            <form action="{{ route('sites.destroy', $site->id) }}"
                                method="POST"
                                style="display:inline-block">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-light"
                                    onclick="return confirm('Are you sure you want to delete this site?')">

                                    <i class="bi bi-trash text-danger"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

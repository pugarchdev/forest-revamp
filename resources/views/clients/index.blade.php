@extends('layouts.app')

@section('title','Clients')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Clients</h5>

            <div>

                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Client
                </a>

                <a href="#" class="btn btn-success">
                    <i class="bi bi-download"></i> Export
                </a>

            </div>

        </div>


        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead class="table-light">

                    <tr>
                        <th>SR. NO</th>
                        <th>Name</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($clients as $client)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <a href="{{ route('clients.show',$client->id) }}">
                                {{ $client->name }}
                            </a>
                        </td>

                        <td>{{ $client->state }}</td>

                        <td>{{ $client->city }}</td>

                        <td>

                            @if($client->isActive)
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif

                        </td>

                        <td>

                            <a href="{{ route('clients.show',$client->id) }}"
                                class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('clients.edit',$client->id) }}"
                                class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('clients.destroy',$client->id) }}"
                                method="POST"
                                style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete this client?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center">No Clients Found</td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $clients->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
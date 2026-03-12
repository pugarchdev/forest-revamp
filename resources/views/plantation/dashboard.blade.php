@extends('layouts.app')

@section('title','Plantation Dashboard')

@section('content')

<div class="container py-4">

    <!-- HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-0">Plantation Dashboard</h4>
            <small class="text-muted">Manage active plantation workflows</small>
        </div>

    </div>

    <!-- PLANTATION TABLE -->

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table align-middle table-hover">

                    <thead class="border-bottom">

                        <tr class="text-muted">

                            <th>Code</th>
                            <th>Name</th>
                            <th>Grid</th>
                            <th>Phase</th>
                            <th class="text-end">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($plantations as $pln)

                        <tr>

                            <td class="fw-semibold">
                                {{ $pln->code }}
                            </td>

                            <td>
                                {{ $pln->name }}
                            </td>

                            <td>
                                <span class="badge bg-secondary-subtle text-secondary">
                                    {{ $pln->grid_id }}
                                </span>
                            </td>

                            <td>

                                <span class="badge bg-info-subtle text-info">
                                    {{ ucfirst($pln->current_phase) }}
                                </span>

                            </td>

                            <td class="text-end">

                                <a href="/plantation/workflow/{{$pln->id}}"
                                    class="btn btn-success btn-sm">

                                    Open Workflow →

                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="text-center py-4 text-muted">
                                No plantations available
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                <i class="bi bi-clock-history text-primary"></i>
                {{ $site->name }} - Shifts
            </h5>

            <div>

                <a href="{{ route('sites.index') }}" class="btn btn-light border me-2">
                    <i class="bi bi-arrow-left"></i> Back
                </a>

                <a href="{{ route('shifts.create',$site->id) }}" class="btn btn-primary">
                    <i class="bi bi-plus"></i> Add Shift
                </a>

            </div>

        </div>


        <div class="card-body p-0">

            <table id="shiftsTable" class="table table-bordered table-hover">

                <thead class="table-light">
                    <tr>
                        <th>Sr. No.</th>
                        <th>Shift Name</th>
                        <th>Shift Start Time</th>
                        <th>Shift End Time</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($shifts as $shift)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $shift->shift_name }}</td>

                        <td>{{ explode('-', $shift->shift_time)[0] }}</td>

                        <td>{{ explode('-', $shift->shift_time)[1] }}</td>

                        <td>

                            <a href="{{ route('shifts.edit', [$site->id,$shift->id]) }}"
                                class="btn btn-sm btn-light">

                                <i class="bi bi-pencil text-warning"></i>

                            </a>

                            <form action="{{ route('shifts.destroy', [$site->id,$shift->id]) }}"
                                method="POST"
                                style="display:inline-block">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-light"
                                    onclick="return confirm('Delete this shift?')">

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

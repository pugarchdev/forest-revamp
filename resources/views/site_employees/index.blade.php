@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>{{ $site->name }} - Assigned Employees</h4>

            <a href="{{ route('site.employees.create',$site->id) }}"
                class="btn btn-primary">

                + Assign Employees

            </a>

        </div>


        <div class="card-body">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>Sr No.</th>
                        <th>Employee Name</th>
                        <th>Duration</th>
                        <th>Shift</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($employees as $key => $emp)

                    <tr>

                        <td>{{ $key+1 }}</td>

                        <td>{{ $emp->user_name }}</td>

                        <td>

                            {{ $emp->startDate ? \Carbon\Carbon::parse($emp->startDate)->format('d M Y') : '-' }}

                            to

                            {{ $emp->endDate ? \Carbon\Carbon::parse($emp->endDate)->format('d M Y') : 'Present' }}

                        </td>

                        <td>

                            {{ $emp->shift_name }}

                            <br>

                            {{ $emp->shift_time }}

                        </td>

                        <td class="text-center">

                            <a href="{{ route('site.employees.show', [$site->id, $emp->id]) }}"
                                class="btn btn-sm btn-info me-1">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('site.employees.edit', [$site->id, $emp->id]) }}"
                                class="btn btn-warning btn-sm rounded-circle">

                                <i class="bi bi-pencil"></i>

                            </a>

                            <form action="{{ route('site.employees.destroy', [$site->id, $emp->id]) }}"
                                method="POST"
                                style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm rounded-circle"
                                    onclick="return confirm('Remove this employee?')">

                                    <i class="bi bi-trash"></i>

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

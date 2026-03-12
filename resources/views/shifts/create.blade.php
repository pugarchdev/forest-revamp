@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Add Shift</h5>

            <a href="{{ route('shifts.index',$site->id) }}" class="btn btn-light border">
                Back
            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('shifts.store',$site->id) }}" method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">
                            Shift Name *
                        </label>

                        <input type="text"
                            name="shift_name"
                            class="form-control"
                            placeholder="Enter shift name"
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">
                            Shift Start Time *
                        </label>

                        <input type="time"
                            name="start_time"
                            class="form-control"
                            required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">
                            Shift End Time *
                        </label>

                        <input type="time"
                            name="end_time"
                            class="form-control"
                            required>
                    </div>

                </div>

                <div class="mt-3">

                    <button class="btn btn-success px-4">
                        Save
                    </button>

                    <a href="{{ route('shifts.index',$site->id) }}"
                        class="btn btn-secondary">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

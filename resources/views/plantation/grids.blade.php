@extends('layouts.app')

@section('title','Grid Management')

@section('content')

<div class="container py-4">

<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4">

<div>
<h4 class="fw-bold mb-0">Grid Management</h4>
<small class="text-muted">Monitor grid availability and usage</small>
</div>

</div>

<!-- GRID CARD -->

<div class="card shadow-sm border-0">

<div class="card-body">

<div class="table-responsive">

<table class="table align-middle table-hover">

<thead class="border-bottom">

<tr class="text-muted">

<th>Grid Code</th>
<th>Status</th>

</tr>

</thead>

<tbody>

@forelse($grids as $grid)

<tr>

<td class="fw-semibold">
{{ $grid->grid_code }}
</td>

<td>

@if($grid->is_active)

<span class="badge bg-danger-subtle text-danger px-3 py-2">
● Used
</span>

@else

<span class="badge bg-success-subtle text-success px-3 py-2">
● Available
</span>

@endif

</td>

</tr>

@empty

<tr>

<td colspan="2" class="text-center py-4 text-muted">
No grids found
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

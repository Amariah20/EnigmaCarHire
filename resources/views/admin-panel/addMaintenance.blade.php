@extends('layouts.admin')

@section('content')

<h1 style="text-align:centre"> Add Maintenance </h1>
<br>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{route('storeMaintenance')}}">
    @csrf 

    <div class="mb-3">
        <label class="form-label"> Vehicle</label>
        <select name="vehicle_id" class="form-control" required>
            <option value="">Select Vehicle</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->vehicle_id }}" {{ old('vehicle_id') == $vehicle->vehicle_id ? 'selected' : '' }}>
                    {{ $vehicle->vehicle_name }} 
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label class="form-label">Maintenance Type</label>
    <select name="maintenance_type" class="form-control" required>
        <option value="">Select Type</option>
        <option value="service" {{ old('maintenance_type') == 'service' ? 'selected' : '' }}>Service</option>
        <option value="repair" {{ old('maintenance_type') == 'repair' ? 'selected' : '' }}>Repair</option>
        <option value="inspection" {{ old('maintenance_type') == 'inspection' ? 'selected' : '' }}>Inspection</option>
        <option value="cleaning" {{ old('maintenance_type') == 'cleaning' ? 'selected' : '' }}>Cleaning</option>
        <option value="other" {{ old('maintenance_type') == 'other' ? 'selected' : '' }}>Other</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <input type="text" class="form-control" name="description" value="{{ old('description') }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" class="form-control" name="due_date" value="{{ old('due_date') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price') }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label"> Status</label>
    <select name="status" class="form-control" required>
        <option value="">Select Status</option>
        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="upcoming" {{ old('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
        <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">Add Maintenance</button>
</form>

@endsection

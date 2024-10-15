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
                <option value="{{ $vehicle->vehicle_id }}">{{ $vehicle->vehicle_name }} </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label class="form-label">Maintenance Type</label>
    <select name=maintenance_type class="form-control" required>
    <option value="">Select Type</option>
    <option value="service">Service</option>
    <option value="repair">Repair</option>
    <option value="inspection">Inspection</option>
    <option value="cleaning">Cleaning</option>
    <option value="other">Other</option>
    </select>
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <input type="text" class="form-control" name="description" >
  </div>

  <div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" class="form-control" name="due_date" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" step="0.01" class="form-control" name="price" required>
  </div>

  <div class="mb-3">
  <label class="form-label"> Status</label>
  <select name="status" class="form-control" required>
      <option value="">Select Status</option>
      <option value="completed">Completed</option>
      <option value="Upcoming">Upcoming</option>
      <option value="In progress">In Progress</option>
      <option value="Cancelled">Cancelled</option>
  </select>
</div>

 
 
  <button type="submit" class="btn btn-primary">Add Maintenance</button>
</form>



@endsection
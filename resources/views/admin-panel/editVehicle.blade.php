@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Edit Vehicle</h1>
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



<form method="POST" action="{{route('storeEditVehicle', ['vehicle_id'=>$vehicle->vehicle_id])}}" enctype="multipart/form-data">
    @csrf 

  <div class="mb-3">
    <label class="form-label">Vehicle Name</label>
    <input type="text" class="form-control" name="vehiclename" value="{{$vehicle->vehicle_name}}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Make & Model</label>
    <input type="text" class="form-control" name="makemodel"value="{{$vehicle->make_model}}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">License Plate</label>
    <input type="text" class="form-control" name="license" value="{{$vehicle->license_plate}}" required>
  </div>
  <div class="mb-3">
  <label class="form-label" >Type</label>
  <select name="type" class="form-control" value="{{$vehicle->type}}" required>
      <option value="SUV">SUV</option>
      <option value="Sedan">Sedan</option>
      <option value="Hatchback">Hatchback</option>
      <option value="Convertible">Convertible</option>
      <option value="Coupe">Coupe</option>
      <option value="Wagon">Wagon</option>
      <option value="Sports Car">Sports Car</option>
      <option value="Crossover">Crossover</option>
      <option value="Electric">Electric</option>
      <option value="Luxury Car">Luxury Car</option>
      <option value="Hybrid">Hybrid</option>
  </select>
</div>
<div class="mb-3">
    <label class="form-label">Transmission</label>
    <select name=transmission class="form-control" value="{{$vehicle->transmission}}" required>
        <option value="automatic">Automatic</option>
        <option value="manual">Manual</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name=status class="form-control" value="{{$vehicle->status}}" required>
        <option value="available">Available</option>
        <option value="rented">Rented</option>
        <option value="in service">In Service</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Daily Rate</label>
    <input type="number" class="form-control" name="dailyrate" value="{{$vehicle->daily_rate}}" required>
  </div>
 
  <div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" class="form-control" name="image">
  </div>
  <button type="submit" class="btn btn-primary">Update Vehicle</button>
</form>



@endsection
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Add Vehicle </h1>
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



<form method="POST" action="{{route('storeVehicle')}}" enctype="multipart/form-data">
    @csrf 
  <div class="mb-3">
    <label class="form-label">Vehicle Name</label>
    <input type="text" class="form-control" name="vehiclename" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Make & Model</label>
    <input type="text" class="form-control" name="makemodel" required>
  </div>
  <div class="mb-3">
    <label class="form-label">License Plate</label>
    <input type="text" class="form-control" name="license" required>
  </div>
  <div class="mb-3">
  <label class="form-label" >Type</label>
  <select name="type" class="form-control" required>
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
    <select name=transmission class="form-control" required>
        <option value="automatic">Automatic</option>
        <option value="manual">Manual</option>
    </select>
  </div>
  <div class="mb-3">
    <label class="form-label">Daily Rate</label>
    <input type="number" class="form-control" name="dailyrate" required>
  </div>
 
  <div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file" class="form-control" name="image" required>
  </div>
  <button type="submit" class="btn btn-primary">Add Vehicle</button>
</form>



@endsection
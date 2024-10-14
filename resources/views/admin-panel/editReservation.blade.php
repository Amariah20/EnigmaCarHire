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
    <label class="form-label">Reservation ID</label>
    <input type="number " class="form-control" name="reservation_id" value="{{$reservation->reservation_id}}" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Customer ID</label>
    <input type="number" class="form-control" name="customer_id" value="{{$reservation->customer_id}}" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Customer Name</label>
    <input type="text" class="form-control" name="customer_name" value="{{$reservation->customer ? $reservation->customer->name : 'N/A'}}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Additional Driver</label> <!--later connect to additional driver, and fix to update additional driver in respective table too-->
    <input type="text" class="form-control" name="additional_driver" value="N/A" readonly> 
  </div>
  <div class="mb-3">
    <label class="form-label">Vehicle ID</label> <!--changing vehicle name, automatically changes vehicle ID)-->
    <input type="number" class="form-control" name="vehicle_id" value="{{$reservation->vehicle_id}}" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Vehicle Name</label> <!--drop down of existing vehicles-->
    <input type="text" class="form-control" name="vehicle_name" value="" required>
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
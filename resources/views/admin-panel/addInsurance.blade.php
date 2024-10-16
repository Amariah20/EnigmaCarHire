@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Add Insurance </h1>
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



<form method="POST" action="{{route('storeInsurance')}}">
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
        <label class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" name="price" required>
    </div>

 
  <div class="mb-3">
    <label class="form-label">Due Date</label>
    <input type="date" class="form-control" name="due_date" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Expiration Date</label>
    <input type="date" class="form-control" name="expiration_date" required>
  </div>

  

  <div class="mb-3">
  <label class="form-label"> Status</label>
  <select name="status" class="form-control" required>
      <option value="">Select Status</option>
      <option value="completed">Paid</option>
      <option value="upcoming">Upcoming</option>
      <option value="cancelled">Cancelled</option>
  </select>
</div>

 
 
  <button type="submit" class="btn btn-primary">Add Insurance</button>
</form>



@endsection
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Edit Reservation</h1>
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



<form method="POST" action="{{route('storeEditReservation', ['reservation_id'=>$reservation->reservation_id])}}" >
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
    <input type="text" class="form-control" name="customer_name" value="{{$reservation->customer ? $reservation->customer->name : 'N/A'}}" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Additional Driver</label> <!--later connect to additional driver, and fix to update additional driver in respective table too-->
    <input type="text" class="form-control" name="additional_driver" value="{{ $reservation->additionalDriver ? $reservation->additionalDriver->name : 'N/A' }}" required> 
  </div>
  <div class="mb-3">
        <label class="form-label">Vehicle Name</label>
        <select class="form-control" name="vehicle_id" required>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->vehicle_id }}" 
                    {{ $reservation->vehicle_id == $vehicle->vehicle_id ? 'selected' : '' }}>
                    {{ $vehicle->vehicle_name }}
                </option>
            @endforeach
        </select>
    </div>

  <div class="mb-3">
    <label class="form-label">Reservation Date</label>
    <input type="date" class="form-control" name="reservation_date" value="{{$reservation->reservation_date}}" readonly>
  </div>
  <div class="mb-3">
    <label class="form-label">Collection</label>
    <input type="datetime-local" class="form-control" name="collection" value="{{$reservation->pick_up}}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Return</label>
    <input type="datetime-local" class="form-control" name="return" value="{{$reservation->return}}" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Total Price</label> <!--have formula to automatically calculate total price based on vehicle_id (daily rate) & collection & return date-->
    <input type="number" class="form-control" name="total_price" value="{{$reservation->total_price}}" readonly> 
  </div>

  <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>
  

  <button type="submit" class="btn btn-primary">Update Reservation</button>
</form>



@endsection
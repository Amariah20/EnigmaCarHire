@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Edit Payment</h1>
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



<form method="POST" action="{{route('storeEditPayment', ['payment_id'=>$payment->payment_id])}}" >
    @csrf 

    <div class="mb-3">
        <label class="form-label">Payment ID</label>
        <input type="number" class="form-control" name="payment_id" value="{{$payment->payment_id}}" readonly>
     </div>

  <div class="mb-3">
    <label class="form-label">Reservation ID</label>
    <input type="number " class="form-control" name="reservation_id" value="{{$payment->reservation_id}}" readonly>
  </div>
  
  <div class="mb-3">
    <label class="form-label">Total Price</label>
    <input type="number" class="form-control" name="total_price" value="{{ $payment->reservation ? $payment->reservation->total_price : 'N/A' }}" readonly>
  </div>

  <div class="mb-3">
    <label class="form-label">Total Paid</label>
    <input type="number" step="0.01" class="form-control" name="total_paid" value="{{ $payment->total_paid }}" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Payment Date</label>
    <input type="date" class="form-control" name="payment_date" value="{{$payment->payment_date}}" required>
  </div>
  

  <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" disabled>
            <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid</option>
            <option value="partially-paid" {{ $payment->status == 'partially-paid' ? 'selected' : '' }}>Partially Paid</option>
            <option value="not-paid" {{ $payment->status == 'not-paid' ? 'selected' : '' }}>Not Paid</option>
            <option value="cancelled" {{ $payment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>
  

  <button type="submit" class="btn btn-primary">Update Payment</button>
</form>



@endsection
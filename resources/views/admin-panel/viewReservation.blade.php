@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="text-center mb-4">Reservation Details</h1>

    <!-- Reservation Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Reservation Information</h3>
        </div>
        <div class="card-body">
            <p><strong>Reservation ID:</strong> {{$reservation->reservation_id}}</p>
            <p><strong>Customer ID:</strong> {{$reservation->customer_id}}</p>
            <p><strong>Customer Name:</strong> {{$reservation->customer ? $reservation->customer->name : 'N/A'}}</p>
            <p><strong>Additional Driver:</strong> {{ $reservation->additionalDriver ? $reservation->additionalDriver->name : 'N/A' }}</p>
            <p><strong>Vehicle ID:</strong> {{$reservation->vehicle_id}}</p>
            <p><strong>Vehicle Name:</strong> {{ $reservation->vehicle ? $reservation->vehicle->vehicle_name : 'N/A' }}</p>
            <p><strong>Reservation Date:</strong> {{$reservation->reservation_date}}</p>
            <p><strong>Pick-up Location:</strong> {{$reservation->pick_up}}</p>
            <p><strong>Return Location:</strong> {{$reservation->return}}</p>
            <p><strong>Total Price:</strong> {{$reservation->total_price}}</p>
            <p><strong>Status:</strong> {{$reservation->status}}</p>
            <a href="{{route('editReservation', ['reservation_id'=>$reservation->reservation_id])}}" class="btn btn-primary mt-3">Edit Reservation Details</a>
        </div>
    </div>

    <!-- Customer Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Customer Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{$reservation->customer ? $reservation->customer->name : 'N/A'}}</p>
            <p><strong>Email:</strong> {{$reservation->customer ? $reservation->customer->email : 'N/A'}}</p>
            <p><strong>Phone Number:</strong> {{$reservation->customer ? $reservation->customer->phone_number : 'N/A'}}</p>
            <p><strong>License Number:</strong> {{$reservation->customer ? $reservation->customer->license_number : 'N/A'}}</p>
            <p><strong>Issuing Country:</strong> {{$reservation->customer ? $reservation->customer->issuing_country : 'N/A'}}</p>
        </div>
    </div>

    <!-- Additional Driver Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Additional Driver Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $reservation->additionalDriver ? $reservation->additionalDriver->name : 'N/A' }}</p>
            <p><strong>License Number:</strong> {{ $reservation->additionalDriver ? $reservation->additionalDriver->license_number : 'N/A' }}</p>
            <p><strong>Issuing Country:</strong> {{ $reservation->additionalDriver ? $reservation->additionalDriver->issuing_country : 'N/A' }}</p>
        </div>
    </div>

    <!-- Payment Details Card -->
    <div class="card mb-4">
        <div class="card-header">
            <h3>Payment Details</h3>
        </div>
        <div class="card-body">
            @if($payment)
                <p><strong>Payment ID:</strong> {{$payment->payment_id}}</p>
                <p><strong>Total Price:</strong> {{ $payment->reservation ? $payment->reservation->total_price : 'N/A' }}</p>
                <p><strong>Total Paid:</strong> {{ $payment->total_paid }}</p>
                <p><strong>Payment Date:</strong> {{$payment->payment_date}}</p>
                <p><strong>Status:</strong> {{ $payment->status}}</p>
                <a href="{{route('editPayment', ['payment_id'=>$payment->payment_id])}}" class="btn btn-primary mt-3">Edit Payment Details</a>
            @else
                <p>No payment information available for this reservation.</p>
            @endif
        </div>
    </div>
</div>

@endsection

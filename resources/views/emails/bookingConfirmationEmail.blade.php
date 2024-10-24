<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ $reservation->customer->name }},</p>

    <p>Your reservation has been confirmed!</p>
    <h3>Reservation Details:</h3>
    <p>Vehicle: {{$vehicle->vehicle_name}}</p>
    <p>Pickup Date & Time: {{ $reservation->pick_up }}</p>
    <p>Pickup Location: {{ $pickupLocation->location_name }}, {{ $pickupLocation->address }}</p>
    <p>Return Date & Time: {{ $reservation->return }}</p>
    <p>Return Location: {{ $dropoffLocation->location_name  }}, {{ $dropoffLocation->address }}</p>

    <h3>Add Ons:</h3>
    
        @foreach($extras as $extra)
            <p>{{ $extra->extra_name }} - SCR {{ number_format($extra->price,2) }}</p> <!-- Adjust according to your extras model -->
        @endforeach


    @if($additionalDriver)
        <h3>Additional Driver Details:</h3>
        <p>Name: {{ $additionalDriver->name }}</p>
        <p>License Number: {{ $additionalDriver->license_number }}</p>
        <p>Issuing Country: {{ $additionalDriver->issuing_country }}</p>
    @endif

    <h3>Payment Details:</h3>

    <p>Total Price: SCR {{number_format($reservation->total_price,2) }}</p>
    <p>Total Paid: SCR {{ number_format($payment->total_paid,2) }}</p>
    <p>Payment Status: {{ $payment->status }}</p>

    <p>Thank you for choosing us!</p>
    <p>Please do not reply to this email. If you have any queries please message us at: enigmaticrides@seychellescar.com </p>
</body>
</html>

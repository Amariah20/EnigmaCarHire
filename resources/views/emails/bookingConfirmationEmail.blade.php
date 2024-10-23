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
    <p>Pickup Date: {{ $reservation->pick_up }}</p>
    <p>Return Date: {{ $reservation->return }}</p>
    <p>Total Price: {{ $reservation->total_price }}</p>


    <h3>Payment Details:</h3>
    <p>Total Paid: {{ $payment->total_paid }}</p>
    <p>Payment Status: {{ $payment->status }}</p>

    @if($additionalDriver)
        <h3>Additional Driver Details:</h3>
        <p>Name: {{ $additionalDriver->name }}</p>
        <p>License Number: {{ $additionalDriver->license_number }}</p>
        <p>Issuing Country: {{ $additionalDriver->issuing_country }}</p>
    @endif

    <p>Thank you for choosing us!</p>
    <p>Please do not reply to this email. If you have any queries please message us at: enigmaticrides@seychellescar.com </p>
</body>
</html>

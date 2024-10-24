@extends('layouts.app')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h3 class="text-center">Rental Terms</h3>
    <ul class="list-unstyled">
        @foreach($terms as $term)
         <li>{{$term->rental_terms}}</li>
        @endforeach
    </ul>

    <form method="POST" action="{{ route('confirm') }}">
        @csrf

        <div class="form-group">
            <input type="checkbox" id="accept_terms" name="accept_terms" value="1" {{ old('accept_terms') ? 'checked' : '' }}>
            <label for="accept_terms">I accept the rental terms and conditions</label>
        </div>

        <h3 class="text-center">Payment</h3>

        <h4>Total Price: {{$total_price}}</h4>
        <p>Choose Payment Type:</p>

        <!-- Radio buttons for payment types -->
        <div class="form-group">
            <div class="form-check">
                <input type="radio" class="form-check-input" name="payment_type" value="full_payment" {{ old('payment_type') == 'full_payment' ? 'checked' : '' }} id="full_payment">
                <label class="form-check-label" for="full_payment">Full Payment</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="payment_type" value="deposit" {{ old('payment_type') == 'deposit' ? 'checked' : '' }} id="deposit">
                <label class="form-check-label" for="deposit">50% Deposit</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="payment_type" value="pay_on_collection" {{ old('payment_type') == 'pay_on_collection' ? 'checked' : '' }} id="pay_on_collection">
                <label class="form-check-label" for="pay_on_collection">Pay Upon Collection</label>
            </div>
        </div>

        <!-- Hidden Fields -->
        <input type="hidden" name="vehicle_id" value="{{ old('vehicle_id', $vehicle_id) }}">
        <input type="hidden" name="pick_up_date" value="{{ old('pick_up_date', $pick_up_date) }}">
        <input type="hidden" name="return_date" value="{{ old('return_date', $return_date) }}">
        <input type="hidden" name="additional_driver_name" value="{{ old('additional_driver_name', $additional_driver_name) }}">
        <input type="hidden" name="additional_license_number" value="{{ old('additional_license_number', $additional_license_number) }}">
        <input type="hidden" name="additional_issuing_country" value="{{ old('additional_issuing_country', $additional_issuing_country) }}">
        <input type="hidden" name="total_price" value="{{ old('total_price', $total_price) }}">
        <input type="hidden" name="selected_extras" value="{{ old('selected_extras', json_encode($selected_extras)) }}">
        <input type="hidden" name="pick_up_location" value="{{ old('pick_up_location', $pick_up_location) }}">
        <input type="hidden" name="drop_off_location" value="{{ old('drop_off_location', $drop_off_location) }}">




        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Confirm</button>
        </div>
    </form>
</div>

@endsection

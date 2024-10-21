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

<h3 class="text-center">Add Ons</h3>



<!-- Add Ons form -->
<form method="POST" action="{{ route('addOns') }}">
    @csrf
    
    <!-- Child Seat Option -->
    <div class="form-group mb-3">
        <input type="checkbox" id="child_seat" name="add_ons[]" value="child_seat" 
        {{ (is_array(old('add_ons')) && in_array('child_seat', old('add_ons'))) ? 'checked' : '' }}>
        <label for="child_seat">Child Seat ($15)</label>
    </div>
    
    <!-- Additional Driver Option -->
    <div class="form-group mb-3">
        <input type="checkbox" id="additional_driver" name="add_ons[]" value="additional_driver" 
        {{ (is_array(old('add_ons')) && in_array('additional_driver', old('add_ons'))) ? 'checked' : '' }}>
        <label for="additional_driver">Additional Driver (Free)</label>
    </div>

    <!-- Always show additional driver details form -->
    <div id="additional_driver_form" style="margin-top: 20px;">
        <h5>Additional Driver Details</h5>
        
        <div class="form-group mb-3">
            <label for="driver_name">Driver Name</label>
            <input type="text" id="driver_name" name="driver_name" class="form-control" value="{{ old('driver_name') }}" placeholder="Enter driver name">
        </div>
        
        <div class="form-group mb-3">
            <label for="license_number">License Number</label>
            <input type="text" id="license_number" name="license_number" class="form-control" value="{{ old('license_number') }}" placeholder="Enter license number">
        </div>
        
        <div class="form-group mb-3">
            <label for="issuing_country">Issuing Country</label> <!--DROP DOWN-->
            <input type="text" id="issuing_country" name="issuing_country" class="form-control" value="{{ old('issuing_country') }}" placeholder="Enter issuing country">
        </div>
    </div>
    
    <!-- Submit Button -->

    <input type="hidden" name="collection" value="{{ $pick_up_date }}">
                        <input type="hidden" name="return" value="{{ $return_date }}">
                        <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
    <button type="submit" class="btn btn-primary">Continue</button>
</form>

@endsection

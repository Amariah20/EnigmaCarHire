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

<h3 class="text-center fw-bold">Available Vehicles</h3>
<br><br>

<div class="row">
    @foreach($vehicles as $vehicle)
        <div class="col-sm-6 col-md-4 mb-4"> <!-- Responsive columns for small and medium screens -->
            <div class="card shadow">
                <img src="{{ asset('public/vehicles/'.$vehicle->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $vehicle->vehicle_name }}">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ ucfirst($vehicle->vehicle_name) }}</h5>
                    <p class="card-text">SCR {{ number_format($vehicle->daily_rate, 2) }}/day</p>
                    <p class="card-text mb-1"><small>{{ ucfirst($vehicle->make_model) }}</small></p>
                    <p class="card-text mb-1"><small>{{ ucfirst($vehicle->type) }}</small></p>
                    <p class="card-text mb-1"><small>{{ ucfirst($vehicle->transmission) }}</small></p>

                    <form method="POST" action="{{ route('addOns') }}">
                        @csrf
                        <input type="hidden" name="collection" value="{{ old('collection', $pick_up_date) }}">
                        <input type="hidden" name="return" value="{{ old('return', $return_date) }}">
                        <input type="hidden" name="vehicle_id" value="{{ old('vehicle_id', $vehicle->vehicle_id) }}">

                        <button type="submit" class="btn btn-secondary w-100">Book Now</button> <!-- Full width on small screens -->
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

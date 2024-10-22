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


   <!-- Filter Checklist -->
<div class="d-flex justify-content-end mb-3">
    <form id="filterForm" action="{{ route('filterAvailableVehicle') }}" method="GET" class="d-flex flex-column flex-md-row align-items-md-center">
        <div class="filter-options me-md-2 mb-2 mb-md-0">
            <p>Filter:</p>
            @foreach($allVehicleTypes as $type)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type }}" id="type-{{ $type }}" 
                       {{ in_array($type, $selectedTypes ?? []) ? 'checked' : '' }}>
                <label class="form-check-label" for="type-{{ $type }}">
                    {{ $type }}
                </label>
            </div>
            @endforeach

            @foreach($allTransmissions as $transmission)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="transmissions[]" value="{{ $transmission }}" id="transmission-{{ $transmission }}" 
                       {{ in_array($transmission, $selectedTransmissions ?? []) ? 'checked' : '' }}>
                <label class="form-check-label" for="transmission-{{ $transmission }}">
                    {{ $transmission }}
                </label>
            </div>
            @endforeach
        </div>

        <input type="hidden" name="pick_up_date" value="{{ old('pick_up_date', $pick_up_date) }}">
        <input type="hidden" name="return_date" value="{{ old('return_date', $return_date) }}">
        <button type="submit" class="btn btn-secondary">Filter</button>
    </form>
</div>



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
                        <input type="hidden" name="pick_up_date" value="{{ old('pick_up_date', $pick_up_date) }}">
                        <input type="hidden" name="return_date" value="{{ old('return_date', $return_date) }}">
                        <input type="hidden" name="vehicle_id" value="{{ old('vehicle_id', $vehicle->vehicle_id) }}">

                        <button type="submit" class="btn btn-secondary w-100">Book Now</button> <!-- Full width on small screens -->
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

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

<div class="container mt-5">

    <!-- Sorting and Filter Form Combined -->
    <form id="sortFilterForm" action="{{ route('sortFilterVehicle') }}" method="GET" class="d-flex flex-column align-items-end"> 
        <!-- Sorting Dropdown (Shorter width) -->
        <div class="mb-2" style="width: 170px;">
            <select name="sort" id="sortDropdown" class="form-select form-select-sm">
                <option value="">Sort</option>
                <option value="price-ascending" {{ request('sort') == 'price-ascending' ? 'selected' : '' }}>Price (Ascending)</option>
                <option value="price-descending" {{ request('sort') == 'price-descending' ? 'selected' : '' }}>Price (Descending)</option>
            </select>
        </div>

        <!-- Filter Options -->
        <div class="filter-options mb-2 text-end" style="max-width: 300px;">
            <p class="mb-1">Filter:</p>
            @foreach($allVehicleTypes as $type)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type }}" id="type-{{ $type }}" 
                           {{ in_array($type, request()->types ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="type-{{ $type }}">
                        {{ $type }}
                    </label>
                </div>
            @endforeach

            @foreach($allTransmissions as $transmission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="transmissions[]" value="{{ $transmission }}" id="transmission-{{ $transmission }}" 
                           {{ in_array($transmission, request()->transmissions ?? []) ? 'checked' : '' }}>
                    <label class="form-check-label" for="transmission-{{ $transmission }}">
                        {{ $transmission }}
                    </label>
                </div>
            @endforeach
        </div>

        <!-- Apply Button -->
        <button type="submit" class="btn btn-secondary btn-sm">Apply</button>
    </form>

    <!-- Rental Form -->
    <div class="container mt-5">
        <h3 class="text-center">Find Your Rental Car</h3>
        <form id="rental-form" class="rental-form-container d-flex flex-column flex-md-row justify-content-center" method="get" action="{{route('showAvailableVehicles')}}">
            <div class="input-group me-md-2 mb-2 mb-md-0">
                <span class="input-group-text">Collection</span>
                <input type="datetime-local" name="pick_up_date" class="form-control" required>
            </div>
            <div class="input-group me-md-2 mb-2 mb-md-0">
                <span class="input-group-text">Return</span>
                <input type="datetime-local" name="return_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>

    <br><br>

    <!-- Fleet Section -->
    <h3 class="text-center fw-bold">Our Fleet</h3>
    <br><br>

    <div class="row">
        @foreach($vehicles as $vehicle)
            <div class="col-sm-6 col-md-4 mb-4"> <!-- Responsive columns -->
                <div class="card shadow">
                    <img src="{{ asset('public/vehicles/'.$vehicle->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $vehicle->vehicle_name }}">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ ucfirst($vehicle->vehicle_name) }}</h5>
                        <p class="card-text">SCR {{ number_format($vehicle->daily_rate, 2) }}/day</p>
                        <p class="card-text mb-1"><small>{{ ucfirst($vehicle->make_model) }}</small></p>
                        <p class="card-text mb-1"><small>{{ ucfirst($vehicle->type) }}</small></p>
                        <p class="card-text mb-1"><small>{{ ucfirst($vehicle->transmission) }}</small></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

@extends('layouts.app')

@section('content')
<div class="container mt-5">
 




 <!-- Sorting Dropdown -->
 <div class="d-flex justify-content-end mb-3"> 
    <form id="sortForm" action="{{ route('sortVehiclePrice') }}" method="GET">
        <select name="sort" id="sortDropdown" class="form-select">
            <option value="">Sort</option>
            <option value="price-ascending">Price (Ascending)</option>
            <option value="price-descending">Price (Descending)</option>
        </select>
        <button type="submit" class="btn btn-secondary mt-2">Sort</button>
    </form>
</div>

<!-- Filter Checklist -->
<div class="d-flex justify-content-end mb-3"> 
    <form id="filterForm" action="{{ route('filterVehicle') }}" method="GET">
        <div class="filter-options">
            <p>Filter by Vehicle Type:</p>
            @foreach($allVehicleTypes as $type) <!-- Display full list of vehicle types -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="types[]" value="{{ $type }}" id="type-{{ $type }}"
                       {{ in_array($type, request()->types ?? []) ? 'checked' : '' }}> <!-- Keep selected types checked -->
                <label class="form-check-label" for="type-{{ $type }}">
                    {{ $type }}
                </label>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-secondary mt-2">Filter</button>
    </form>
</div>









 



    <div class="container mt-5">
    <h3 class="text-center">Find Your Rental Car</h3>
    <form id="rental-form" class="rental-form-container d-flex justify-content-center">
        <div class="input-group me-2">
            <span class="input-group-text">Collection</span>
            <input type="datetime-local" name="pick_up" class="form-control" required>
        </div>
        <div class="input-group me-2">
            <span class="input-group-text">Return</span>
            <input type="datetime-local" name="return" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-secondary">Search</button>
    </form>
</div>

<br><br>

<h3 class="text-center fw-bold">Our Fleet</h3> 
<br><br>


    <div class="row">
        @foreach($vehicles as $vehicle)
            <div class="col-md-4 mb-4"> <!-- Adjust the width for responsiveness -->
                <div class="card shadow">
                    <img src="{{ asset('public/vehicles/'.$vehicle->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $vehicle->vehicle_name }}"> 
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ ucfirst($vehicle->vehicle_name) }}</h5> 
                        <p class="card-text">SCR {{  number_format($vehicle->daily_rate, 2) }}/day</p> 
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

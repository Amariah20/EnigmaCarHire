@extends('layouts.app')

@section('content')


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
<div class="container">
        <div class="card homepage-card shadow-sm">
            <div class="card-header text-center">
                <h4>Find Your Rental Car</h4>
            </div>
            <div class="card-body">
                <form id="rental-form" method="get" action="{{route('showAvailableVehicles')}}">
                   
                    <div class="mb-3">
                        <label class="form-label">Collection Date & Time</label>
                        <input type="datetime-local" name="pick_up_date" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Return Date & Time</label>
                        <input type="datetime-local" name="return_date" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-secondary w-100">Search</button>
                </form>
            </div>
        </div>


         <!-- Additional text below the card -->
        <div class="text-center mt-4">
            <h2 style="font-weight: bold; font-size: 40px; color: black;">Drive Your Dreams with Us</h2>
            <p style="font-size: 30px; color: black;">Experience unparalleled convenience and service. Book with confidence today!</p>
        </div>
        <br>

        <div class="container mt-5">
    <h3 class="text-center">Our Fleet</h3>
    <div class="card">
        <div class="card-body">
            @foreach ($vehicles->take(3) as $index => $vehicle) <!-- Add index to determine the last vehicle -->
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('public/vehicles/'.$vehicle->image) }}" class="rounded-circle me-3" style="width: 50px; height: 50px;" alt="{{ $vehicle->vehicle_name }}">
                    <h5 class="mb-0">{{ $vehicle->vehicle_name }}</h5>
                </div>
                @if ($index < 3)
                    <hr>
                @endif
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{route('ourFleet')}}" class="btn btn-secondary">View More</a> <!-- Link to the vehicles index page -->
        </div> <br>
</div>


        
    </div>

   
    



@endsection
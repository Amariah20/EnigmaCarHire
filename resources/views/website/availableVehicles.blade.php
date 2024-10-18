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




<h3 class="text-center fw-bold">Available Vehicles</h3> 
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
                       
                    <form method="POST" action="{{ route('bookVehicle', ['vehicle_id' => $vehicle->vehicle_id]) }}">
                        @csrf
                        <input type="hidden" name="collection" value="{{ session('pick_up_date') }}">
                        <input type="hidden" name="return" value="{{ session('return_date') }}">
                        <button type="submit" class="btn btn-secondary">Book Now</button>
                    </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
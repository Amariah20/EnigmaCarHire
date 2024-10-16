@extends('layouts.admin')

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

<!-- Vehicle Section -->
<h1 style="text-align:center"> Vehicle Information </h1>
<br>

<div class="card mb-4" style="width: 100%;">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('public/vehicles/' . $vehicle->image) }}" class="img-fluid rounded-start" alt="{{ $vehicle->vehicle_name }}" style="height: 200px; object-fit: cover;">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $vehicle->vehicle_name }}</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Vehicle ID:</strong> {{ $vehicle->vehicle_id }}</li>
                    <li class="list-group-item"><strong>Make & Model:</strong> {{ $vehicle->make_model }}</li>
                    <li class="list-group-item"><strong>License Plate:</strong> {{ $vehicle->license_plate }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $vehicle->type }}</li>
                    <li class="list-group-item"><strong>Transmission:</strong> {{ $vehicle->transmission }}</li>
                    <li class="list-group-item"><strong>Status:</strong> {{ $vehicle->status }}</li>
                    <li class="list-group-item"><strong>Daily Rate:</strong> SCR {{ number_format($vehicle->daily_rate, 2) }}</li>
                </ul>
                <div class="mt-3">
                    <a href="{{ route('editVehicle', ['vehicle_id' => $vehicle->vehicle_id]) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('deleteVehicle', ['vehicle_id' => $vehicle->vehicle_id]) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Reservations Section -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Reservations</h1>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr class="bg-primary text-white">
                    <th scope="col">Reservation ID</th>
                    <th scope="col">Customer ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Additional Driver</th>
                    <th scope="col">Vehicle ID</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Reservation Date</th>
                    <th scope="col">Collection</th>
                    <th scope="col">Return</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                <tr>
                    <td><a href="{{ route('viewReservation', ['reservation_id' => $reservation->reservation_id]) }}">{{ $reservation->reservation_id }}</a></td>
                    <td>{{ $reservation->customer_id }}</td>
                    <td>{{ $reservation->customer ? $reservation->customer->name : 'N/A' }}</td>
                    <td>{{ $reservation->additionalDriver ? $reservation->additionalDriver->name : 'N/A' }}</td>
                    <td>{{ $reservation->vehicle_id }}</td>
                    <td>{{ $reservation->vehicle ? $reservation->vehicle->vehicle_name : 'N/A' }}</td>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td>{{ $reservation->pick_up }}</td>
                    <td>{{ $reservation->return }}</td>
                    <td>SCR {{ number_format($reservation->total_price, 2) }}</td>
                    <td>{{ $reservation->status }}</td>
                    <td>
                        <a href="{{ route('editReservation', ['reservation_id' => $reservation->reservation_id]) }}">
                            <i class="bi bi-pen-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Insurance Section -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Insurance</h1>
    <a href="{{ route('addInsurance') }}" class="btn btn-primary mb-3">Add Insurance</a>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr class="bg-primary text-white">
                    <th scope="col" colspan="4">Total</th>
                    <th scope="col">{{ $totalInsurance }}</th>
                    <th scope="col" colspan="3"></th>
                </tr>
                <tr>
                    <th scope="col">Insurance ID</th>
                    <th scope="col">Vehicle ID</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($insurances as $insurance)
                <tr>
                    <td>{{ $insurance->insurance_id }}</td>
                    <td>{{ $insurance->vehicle_id }}</td>
                    <td>{{ $insurance->vehicle ? $insurance->vehicle->vehicle_name : 'N/A' }}</td>
                    <td>{{ $insurance->due_date }}</td>
                    <td>SCR {{ $insurance->price }}</td>
                    <td>{{ $insurance->status }}</td>
                    <td>
                        <a href="{{ route('editInsurance', ['insurance_id' => $insurance->insurance_id]) }}">
                            <i class="bi bi-pen-fill"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('deleteInsurance', ['insurance_id' => $insurance->insurance_id]) }}">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Maintenance Section -->
<div class="container mt-5">
    <h1 class="text-center mb-4">Maintenance</h1>
    <a href="{{ route('addMaintenance') }}" class="btn btn-primary mb-3">Add Maintenance</a>
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-light">
                <tr class="bg-primary text-white">
                    <th scope="col" colspan="6">Total</th>
                    <th scope="col">{{ $totalMaintenance }}</th>
                    <th scope="col" colspan="3"></th>
                </tr>
                <tr>
                    <th scope="col">Maintenance ID</th>
                    <th scope="col">Vehicle ID</th>
                    <th scope="col">Vehicle Name</th>
                    <th scope="col">Maintenance Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->maintenance_id }}</td>
                    <td>{{ $maintenance->vehicle_id }}</td>
                    <td>{{ $maintenance->vehicle ? $maintenance->vehicle->vehicle_name : 'N/A' }}</td>
                    <td>{{ $maintenance->maintenance_type }}</td>
                    <td>{{ $maintenance->description }}</td>
                    <td>{{ $maintenance->due_date }}</td>
                    <td>SCR {{ $maintenance->price }}</td>
                    <td>{{ $maintenance->status }}</td>
                    <td>
                        <a href="{{ route('editMaintenance', ['maintenance_id' => $maintenance->maintenance_id]) }}">
                            <i class="bi bi-pen-fill"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('deleteMaintenance', ['maintenance_id' => $maintenance->maintenance_id]) }}">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

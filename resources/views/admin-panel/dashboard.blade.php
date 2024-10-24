@extends('layouts.admin')

@section('content')

<div class="content">

    <h1 style="text-align: center;">Dashboard</h1>
    <br>

    <!-- Financial Overview Card -->
    <div class="card mb-4" style="width: 18rem;">
        <div class="card-body">
            <h3 class="card-title">Financial Overview</h3>
            <h4 class="card-text">Outstanding payments</h4>
            <h5 class="card-text">SCR {{ number_format($OutstandingPayments,2)}} </h5>
           
            <a href="{{ route('payments') }}" class="btn btn-secondary">View Details</a>
        </div>
    </div>

    <!-- Maintenance Due Next Week Section -->
    <h3>Maintenance Due Next Week</h3>
    @if($MaintenenacedueNextWeek->isEmpty())
        <p>No maintenance due next week.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Maintenance ID</th>
                    <th>Vehicle ID</th>
                    <th>Vehicle Name</th>
                    <th>Maintenance Type</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($MaintenenacedueNextWeek as $maintenance)
                  <tr>
                    <td>{{$maintenance->maintenance_id}}</td>
                    <td>{{$maintenance->vehicle_id}}</td>
                    <td> {{ $maintenance->vehicle ? $maintenance->vehicle->vehicle_name : 'N/A' }}</td>
                    <td>{{$maintenance->maintenance_type}}</td>
                    <td>{{$maintenance->description}}</td>
                    <td>{{$maintenance->due_date}}</td>
                    <td> SCR {{$maintenance->price}}</td>
                    <td>{{$maintenance->status}}</td>
                    <td><a href="{{route('editMaintenance', ['maintenance_id'=>$maintenance->maintenance_id])}}"><i class="bi bi-pen-fill"></i></a></td>
                    <td><a href="{{route('deleteMaintenance',  ['maintenance_id'=>$maintenance->maintenance_id])}}"><i class="bi bi-trash-fill"></a></i></td>
    
                  </tr>
                @endforeach
            </tbody>
        </table>
    @endif





    <h3>Insurance Due Next Week</h3>
    @if($InsurancedueNextWeek->isEmpty())
        <p>No Insurance due next week.</p>
    @else
        <table class="table table-bordered">
            <thead>
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
                @foreach($InsurancedueNextWeek as $insurance)
                  <tr>
                    <td>{{$insurance->insurance_id}}</td>
                    <td>{{$insurance->vehicle_id}}</td>
                    <td> {{ $insurance->vehicle ? $insurance->vehicle->vehicle_name : 'N/A' }}</td>
                    <td>{{$insurance->due_date}}</td>
                    <td> SCR {{$insurance->price}}</td>
                    <td> {{$insurance->status}}</td>
                    <td><a href="{{route('editInsurance', ['insurance_id'=>$insurance->insurance_id])}}"><i class="bi bi-pen-fill"></i></a></td>
                    <td><a href="{{route('deleteInsurance',   ['insurance_id'=>$insurance->insurance_id])}}"><i class="bi bi-trash-fill"></a></i></td>
    
                  </tr>
                @endforeach
            </tbody>
        </table>
    @endif


</div>

@endsection

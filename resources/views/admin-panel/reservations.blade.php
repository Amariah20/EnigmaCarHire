@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Vehicles </h1>
<br>


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

<!--<a href="{{ route('AddVehicle') }}" class="btn btn-primary">Add Vehicle</a>-->


<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Reservation ID</th>
      <th scope="col">Customer ID</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Additional Driver</th>
      <th scope="col">Vehicle ID </th>
      <th scope="col">Vehicle Name </th>
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
      
      <td>{{$reservation->reservation_id}}</td>
      <td> {{$reservation->customer_id}}</td>
      <td>{{$reservation->customer ? $reservation->customer->name : 'N/A'}}</td>
      <td> N/A</td> <!--later query additional driver table-->
      <td>{{$reservation->vehicle_id}}</td>
      <td> {{ $reservation->vehicle ? $reservation->vehicle->vehicle_name : 'N/A' }}</td>

      <td> {{$reservation->reservation_date}}</td>
      <td> {{$reservation->pick_up}}</td>
      <td> {{$reservation->return}}</td>
      <td> {{$reservation->total_price}}</td>
      <td> {{$reservation->status}}</td>

</tr>
 @endforeach
 </tbody>
 </table>



@endsection
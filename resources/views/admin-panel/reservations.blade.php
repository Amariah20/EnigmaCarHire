@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Reservations </h1>
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
      <th scope="col">Collection Location</th>
      <th scope="col">Return</th>
      <th scope="col">Return Location</th>
      <th scope="col">Total Price</th>
      <th scope="col">Child Seat</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
      <!--<th scope="col">Delete</th>-->
      
    </tr>
  </thead>

  <tbody>
  @foreach($reservations as $reservation)
    <tr>
      
      <td>
        <a href="{{ route('viewReservation', ['reservation_id' => $reservation->reservation_id]) }}">
        {{$reservation->reservation_id}}
        </a>
      </td>
      <td> {{$reservation->customer_id}}</td>
      <td>{{$reservation->customer ? $reservation->customer->name : 'N/A'}}</td>
      <td>{{ $reservation->additionalDriver ? $reservation->additionalDriver->name : 'N/A' }}</td> 
      <td>
      <a href="{{ route('viewVehicle', ['vehicle_id' => $reservation->vehicle_id]) }}">
        {{$reservation->vehicle_id}} </a>
      </td>
      <td> {{ $reservation->vehicle ? $reservation->vehicle->vehicle_name : 'N/A' }}</td>
      <td> {{$reservation->reservation_date}}</td>
      <td> {{$reservation->pick_up}}</td>
      <td>{{ $reservation->pickupLocation ? $reservation->pickupLocation->location_name : 'N/A' }}</td>
      <td> {{$reservation->return}}</td>
      <td>{{ $reservation->dropoffLocation ? $reservation->dropoffLocation->location_name : 'N/A' }}</td>
      <td> {{ number_format($reservation->total_price,2)}}</td>
      <td>{{ $reservation->child_seat ? 'Yes' : 'No' }}</td>
      <td> {{$reservation->status}}</td>
      <td><a href="{{route('editReservation', ['reservation_id'=>$reservation->reservation_id])}}"><i class="bi bi-pen-fill"></i></a></td>
     <!-- <td><a href="{{route('deleteReservation', ['reservation_id'=>$reservation->reservation_id])}}"><i class="bi bi-trash-fill"></a></i></td>--> <!--no need to delete reservations. simply mark as cancelled-->
   
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
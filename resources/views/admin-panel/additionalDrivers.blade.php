
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Additional Drivers </h1>
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
    <th scope="col">Additional Driver ID</th>
    <th scope="col">Reservation ID</th>
     <th scope="col">Name</th>
      <th scope="col">License Number</th>
      <th scope="col">Issuing Country</th>
      
      
      
    </tr>
  </thead>

  <tbody>
  @foreach($additionalDrivers as $additionalDriver)
    <tr>
      
      <td>{{$additionalDriver->additional_driver_id}}</td>
      <td>
      <a href="{{ route('viewReservation', ['reservation_id' => $additionalDriver->reservation_id]) }}">
        {{$additionalDriver->reservation_id}}
      </td>
      <td> {{$additionalDriver->name}}</td>
      <td> {{$additionalDriver->license_number}}</td>
      <td> {{$additionalDriver->issuing_country}}</td>
     
    

   
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
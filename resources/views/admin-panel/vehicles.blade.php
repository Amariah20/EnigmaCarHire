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

<a href="{{ route('AddVehicle') }}" class="btn btn-primary">Add Vehicle</a>


<table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Vehicle Name</th>
      <th scope="col">Make & Model </th>
      <th scope="col">License Plate</th>
      <th scope="col">Type</th>
      <th scope="col">Transmission</th>
      <th scope="col">Status</th>
      <th scope="col">Daily Rate</th>
      <th scope="col">Image</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>
  </thead>

  <tbody>
  @foreach($vehicles as $vehicle)
    <tr>
      
      <td>{{$vehicle->vehicle_name}}</td>
      <td> {{$vehicle->make_model}}</td>
      <td>{{$vehicle->license_plate}}</td>
      <td>{{$vehicle->type}}</td>
      <td> {{$vehicle->transmission}}</td>
      <td>{{$vehicle->status}}</td>
      <td> SCR {{$vehicle->daily_rate}}</td>
      <td> <img src="{{ asset('public/vehicles/'.$vehicle->image) }}"  style="width:50px; height:50px"></td>
      <td><a href="{{route('editVehicle', ['vehicle_id'=>$vehicle->vehicle_id])}}"><i class="bi bi-pen-fill"></i></a></td>
      <td><a href="{{route('deleteVehicle', ['vehicle_id'=>$vehicle->vehicle_id])}}"><i class="bi bi-trash-fill"></a></i></td>
   
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
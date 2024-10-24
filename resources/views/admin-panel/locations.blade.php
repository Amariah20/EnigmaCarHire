
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Locations</h1>
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


<a href="{{ route('addLocation') }}" class="btn btn-primary">Add Location</a>



<table class="table table-hover">
  <thead class="thead-dark">

    <tr>
      <th scope="col">Location ID</th>
      <th scope="col">Location Name</th>
      <th scope="col">Location Address</th>
      <th scope="col">Location Type</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>

    
  </thead>

  <tbody>
  @foreach($locations as $location)
    <tr>
      <td>{{$location->location_id}}</td>
      <td>{{$location->location_name}}</td>
      <td>{{$location->address}}</td>
      <td>{{$location->location_type}}</td>
      <td><a href="{{route('editLocation', ['location_id'=>$location->location_id])}}"><i class="bi bi-pen-fill"></i></a></td>
      <td><a href="{{route('deleteLocation',['location_id'=>$location->location_id])}}"><i class="bi bi-trash-fill"></a></i></td>

      
</tr>
 @endforeach
 </tbody>
 </table>



@endSection
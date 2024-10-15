@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Maintenances </h1>
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

<a href="{{ route('addMaintenance') }}" class="btn btn-primary">Add Maintenance</a>


<table class="table table-hover">
  <thead class="thead-dark">

  <tr>
            <th scope="col" colspan="6">Total</th>
            <th scope="col">{{ $totalPrice }}</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
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



@endsection
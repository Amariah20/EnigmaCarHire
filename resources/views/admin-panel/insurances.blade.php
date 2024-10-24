
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Insurances </h1>
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

<a href="{{ route('addInsurance') }}" class="btn btn-primary">Add Insurance</a>


<table class="table table-hover">
  <thead class="thead-dark">

  <tr>
            <th scope="col" colspan="4">Total</th>
            <th scope="col">{{  number_format($totalPrice,2) }}</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
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
      
      <td>{{$insurance->insurance_id}}</td>
      <td>

      <a href="{{ route('viewVehicle', ['vehicle_id' => $insurance->vehicle_id]) }}">
        {{$insurance->vehicle_id}} </a>
    </td>
      <td> {{ $insurance->vehicle ? $insurance->vehicle->vehicle_name : 'N/A' }}</td>
      <td>{{$insurance->due_date}}</td>
      <td> SCR {{ number_format($insurance->price,2)}}</td>
      <td> {{$insurance->status}}</td>
      <td><a href="{{route('editInsurance', ['insurance_id'=>$insurance->insurance_id])}}"><i class="bi bi-pen-fill"></i></a></td>
      <td><a href="{{route('deleteInsurance',   ['insurance_id'=>$insurance->insurance_id])}}"><i class="bi bi-trash-fill"></a></i></td>
    

   
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
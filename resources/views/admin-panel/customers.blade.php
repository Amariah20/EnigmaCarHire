@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Customers </h1>
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
    <th scope="col">Customer ID</th>
     <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">License Number</th>
      <th scope="col">Issuing Country</th>
      
      
    </tr>
  </thead>

  <tbody>
  @foreach($customers as $customer)
    <tr>
      
      <td> {{$customer->customer_id}} </td>
      <td> {{$customer->name}} </td>
      <td> {{$customer->email}} </td>
      <td> {{$customer->phone_number}} </td>
      <td> {{$customer->license_number}} </td>
      <td> {{$customer->issuing_country}} </td>
     
   
</tr>
 @endforeach
 </tbody>
 </table>

@endsection
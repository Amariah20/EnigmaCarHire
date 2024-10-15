@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Payments </h1>
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
            <th scope="col" colspan="2">Totals</th>
            <th scope="col">{{ $totalPrice }}</th>
            <th scope="col">{{ $totalPaid }}</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    <tr>
      <th scope="col">Payment ID</th>
      <th scope="col">Reservation ID</th>
      <th scope="col">Total Price</th>
      <th scope="col">Total Paid </th>
      <th scope="col">Payment Date </th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
      
      
    </tr>

    
  </thead>

  <tbody>
  @foreach($payments as $payment)
    <tr>
      
      <td>{{$payment->payment_id}}</td>
      <td>{{$payment->reservation_id}}</td>
      <td>{{ $payment->reservation ? $payment->reservation->total_price : 'N/A' }}</td>
      <td>{{ $payment->total_paid }}</td> 
      <td>{{$payment->payment_date}}</td>
      <td>{{ $payment->status}}</td>
      <td><a href="{{route('editPayment', ['payment_id'=>$payment->payment_id])}}"><i class="bi bi-pen-fill"></i></a></td>

      
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
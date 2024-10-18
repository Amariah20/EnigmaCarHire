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
            <th scope="col">{{  number_format($totalPrice,2) }}</th>
            <th scope="col">{{  number_format($totalPaid,2) }}</th>
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
      <td>
        <a href="{{ route('viewReservation', ['reservation_id' => $payment->reservation_id]) }}">
          {{ $payment->reservation_id }}
        </a>
      </td>
      <td>{{  number_format($payment->reservation ? $payment->reservation->total_price : 'N/A',2) }}</td>
      <td>{{  number_format($payment->total_paid,2) }}</td> 
      <td>{{ $payment->payment_date,2}}</td>
      <td>{{ $payment->status}}</td>
      <td><a href="{{route('editPayment', ['payment_id'=>$payment->payment_id])}}"><i class="bi bi-pen-fill"></i></a></td>

      
</tr>
 @endforeach
 </tbody>
 </table>



@endsection

@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Rental Terms and Conditions </h1>
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


<a href="{{ route('addRentalTerm') }}" class="btn btn-primary">Add Rental Condition</a>



<table class="table table-hover">
  <thead class="thead-dark">

    <tr>
      <th scope="col">Rental Condition</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
      
    </tr>

    
  </thead>

  <tbody>
  @foreach($terms as $term)
    <tr>
      
      <td>{{$term->rental_terms}}</td>
      <td><a href="{{route('editRentalTerm', ['rental_terms_id'=>$term->rental_terms_id])}}"><i class="bi bi-pen-fill"></i></a></td>
      <td><a href="{{route('deleteRentalTerm',  ['rental_terms_id'=>$term->rental_terms_id])}}"><i class="bi bi-trash-fill"></a></i></td>

      
</tr>
 @endforeach
 </tbody>
 </table>



@endSection
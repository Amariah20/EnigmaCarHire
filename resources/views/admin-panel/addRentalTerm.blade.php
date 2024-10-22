@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Add Condition </h1>
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



<form method="POST" action="{{route('storeRentalTerm')}}">
    @csrf 




 
  <div class="mb-3">
    <label class="form-label">Rental Condition</label>
    <input type="text" class="form-control" name="rental_term" required>
  </div>



 
 
  <button type="submit" class="btn btn-primary">Add Condition</button>
</form>



@endsection
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Add Location </h1>
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



<form method="POST" action="{{route('storeLocation')}}">
    @csrf 




 
  <div class="mb-3">
    <label class="form-label">Location Name</label>
    <input type="text" class="form-control" name="location_name" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" name="address">
  </div>

 




 
 
  <button type="submit" class="btn btn-primary">Add Location</button>
</form>



@endsection
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Edit Location </h1>
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



<form method="POST" action="{{route('storeEditLocation', ['location_id'=>$location->location_id])}}">
    @csrf 




 
  <div class="mb-3">
    <label class="form-label">Location Name</label>
    <input type="text" class="form-control" name="location_name" value="{{ old('location_name', $location->location_name) }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Address</label>
    <input type="text" class="form-control" name="address" value="{{ old('address', $location->address) }}">
  </div>

  




 
 
  <button type="submit" class="btn btn-primary">Update Location</button>
</form>



@endsection
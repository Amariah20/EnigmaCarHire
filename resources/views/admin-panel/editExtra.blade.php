@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Add Additional Item </h1>
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



<form method="POST" action="{{route('storeEditExtra', ['extra_id' => $extra->extra_id])}}">
    @csrf 




 
  <div class="mb-3">
    <label class="form-label">Additional Item</label>
    <input type="text" class="form-control" name="extra_name" value="{{$extra->extra_name}}">
  </div>

  <div class="mb-3">
    <label class="form-label">Price</label>
    <input type="number" class="form-control" name="price" value="{{$extra->price}}">
  </div>



  <button type="submit" class="btn btn-primary">Edit Additional Item</button>
</form>



@endsection
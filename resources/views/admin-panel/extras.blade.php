
@extends('layouts.admin')

@section('content')

  
<h1 style="text-align:centre"> Additional Items </h1>
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


<a href="{{ route('addExtra') }}" class="btn btn-primary">Add Additional Item</a>


<table class="table table-hover">
  <thead class="thead-dark">

  
    <tr>
    <th scope="col">Additional Item ID</th>
    <th scope="col">Additional Item Name</th>
    <th scope="col">Additional Item Price</th>
    <th scope="col">Edit</th>
    <th scope="col">Delete</th>  
  
  
      
    </tr>
  </thead>

  <tbody>
  @foreach($extras as $extra)
    <tr>
      
      <td>{{$extra->extra_id}}</td>
      <td> {{$extra->extra_name}}</td>
      <td> SCR {{number_format($extra->price, 2)}}</td>
      <td><a href="{{route('editExtra', ['extra_id'=>$extra->extra_id])}}"><i class="bi bi-pen-fill"></i></a></td>
      <td><a href="{{route('deleteExtra',  ['extra_id'=>$extra->extra_id])}}"><i class="bi bi-trash-fill"></a></i></td>

 

   
</tr>
 @endforeach
 </tbody>
 </table>



@endsection
@extends('layouts.app')

@section('content')


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


<h3 class="text-center">Add Ons</h3>

<p>Vehicle ID: {{ $vehicle_id }}</p>
<p>Pick-Up Date: {{ $pick_up_date }}</p>
<p>Return Date: {{ $return_date }}</p>

<!-- Your Add Ons form or other content here -->

@endsection

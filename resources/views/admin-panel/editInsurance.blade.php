@extends('layouts.admin')

@section('content')

<h1 style="text-align:center"> Edit Insurance </h1>
<br>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('storeEditInsurance', ['insurance_id'=>$insurance->insurance_id]) }}">
    @csrf 

    <div class="mb-3">
        <label class="form-label"> Vehicle</label>
        <select name="vehicle_id" class="form-control" required>
            <option value="">Select Vehicle</option>
            @foreach($vehicles as $vehicle)
                <option value="{{ $vehicle->vehicle_id }}" {{ $vehicle->vehicle_id == $insurance->vehicle_id ? 'selected' : '' }}>
                    {{ $vehicle->vehicle_name }} 
                </option>
            @endforeach
        </select>
    </div>

 

    <div class="mb-3">
        <label class="form-label">Due Date</label>
        <input type="date" class="form-control" name="due_date" value="{{ $insurance->due_date }}" required>
    </div>



    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" step="0.01" class="form-control" name="price" value="{{ $insurance->price }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            <option value="">Select Status</option>
            <option value="completed" {{ $insurance->status == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="Upcoming" {{ $insurance->status == 'Upcoming' ? 'selected' : '' }}>Upcoming</option>
            <option value="Cancelled" {{ $insurance->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Insurance</button>
</form>

@endsection

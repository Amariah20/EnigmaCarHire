
@extends('layouts.admin')

@section('content')




  

<div class="content">
  
<h1 style="text-align:centre"> Dashboard </h1>
<br>


<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h3 class="card-title">Financial Overview</h3>
    
    <h4 class="card-text">Outstanding payments</h4>
    <h5 class="card-text">$500</h5> <!--pull data from payments table-->
 
    <button type="button" class="btn btn-secondary" href="#">View Details</button>
  </div>
</div>
</div>




@endsection
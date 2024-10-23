<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Maintenance;
use Carbon\Carbon;
use Laravel\Ui\Presets\React;

class FilterSortController extends Controller
{
  
   


    public function sortAndFilterVehicles(Request $req)
    {
    // Default query to retrieve all vehicles
    $vehiclesQuery = Vehicle::query();
    $allVehicleTypes = Vehicle::pluck('type')->unique();
    $allTransmissions = Vehicle::pluck('transmission')->unique();

    // Handle filtering based on the 'types' and 'transmissions' request value
    $selectedTypes = $req->input('types', []);
    $selectedTransmissions = $req->input('transmissions', []);

    if (!empty($selectedTypes)) {
        $vehiclesQuery->whereIn('type', $selectedTypes);
    }

    if (!empty($selectedTransmissions)) {
        $vehiclesQuery->whereIn('transmission', $selectedTransmissions);
    }

    // Handle sorting based on the 'sort' request value
    if ($req->get('sort') == 'price-ascending') {
        // Sort vehicles by price in ascending order
        $vehiclesQuery->orderBy('daily_rate', 'asc');
    } elseif ($req->get('sort') == 'price-descending') {
        // Sort vehicles by price in descending order
        $vehiclesQuery->orderBy('daily_rate', 'desc');
    }

    // Execute the query to get filtered and sorted vehicles
    $vehicles = $vehiclesQuery->get();

    // Return the view with the sorted and filtered vehicles
    return view('website.ourFleet', compact('vehicles', 'allVehicleTypes', 'allTransmissions'));
}



public function sortFilterAvailableVehicles(Request $req){

    $pick_up_date = Carbon::parse($req->pick_up_date);
    $return_date = Carbon::parse($req->return_date);

    // Step 1: Get all vehicle IDs that are reserved during the selected dates
    $reservedVehicles = Reservation::where(function ($query) use ($pick_up_date, $return_date) {
        $query->where('return', '>=', $pick_up_date) // Reservation ends after or on pick-up date
            ->where('pick_up', '<=', $return_date)
            ->where('status', '!=', 'cancelled');// Reservation starts before or on return date
    })->pluck('vehicle_id'); // Get the list of reserved vehicle IDs


    $pick_up_date_check = Carbon::parse($req->pick_up_date)->subDay();


                // Check for maintenance schedules
                $maintenanceSchedule = Maintenance::where(function($query) use ($pick_up_date_check, $return_date){
                $query->where('status', '!=', 'completed') // Exclude completed maintenance
                    ->where('status', '!=', 'cancelled') // Exclude cancelled maintenance
                    ->where('due_date', '>=', $pick_up_date_check)
                    ->where('due_date', '<=', $return_date);
                })->pluck('vehicle_id');


                $excludedVehicles = $reservedVehicles->merge($maintenanceSchedule);


                // Step 2: Build a query to get available vehicles (those not reserved or under maintenance)
    $vehiclesQuery = Vehicle::whereNotIn('vehicle_id', $excludedVehicles);

    // Step 3: Handle filtering based on the 'types' and 'transmissions' request value
    $allVehicleTypes = Vehicle::pluck('type')->unique();
    $allTransmissions = Vehicle::pluck('transmission')->unique();

    $selectedTypes = $req->input('types', []);
    $selectedTransmissions = $req->input('transmissions', []);

    if (!empty($selectedTypes)) {
        $vehiclesQuery->whereIn('type', $selectedTypes);
    }

    if (!empty($selectedTransmissions)) {
        $vehiclesQuery->whereIn('transmission', $selectedTransmissions);
    }

    // Step 4: Handle sorting based on the 'sort' request value
    if ($req->get('sort') == 'price-ascending') {
        // Sort vehicles by price in ascending order
        $vehiclesQuery->orderBy('daily_rate', 'asc');
    } elseif ($req->get('sort') == 'price-descending') {
        // Sort vehicles by price in descending order
        $vehiclesQuery->orderBy('daily_rate', 'desc');
    }

    // Step 5: Execute the query to get filtered and sorted vehicles
    $vehicles = $vehiclesQuery->get();

    // Step 6: Return view with sorted/filtered available vehicles
    return view('website.availableVehicles', compact('vehicles', 'pick_up_date', 'return_date', 'allVehicleTypes', 'allTransmissions'));
}

}






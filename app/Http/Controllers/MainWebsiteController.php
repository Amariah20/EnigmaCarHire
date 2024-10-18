<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class MainWebsiteController extends Controller
{
    public function homepage(){

        $vehicles = Vehicle::all();
     
        return view ('website.homepage', compact('vehicles'));
    }


    public function ourFleet(){

        $vehicles = Vehicle::all();
        $allVehicleTypes = Vehicle::pluck('type')->unique();
        $allTransmissions = Vehicle::pluck('transmission')->unique();
        

        return view ('website.ourFleet', compact('vehicles', 'allVehicleTypes', 'allTransmissions'));
    }

    public function sortVehiclePrice(Request $req)
    {
        // Default query to retrieve all vehicles
        $vehicles = Vehicle::query();
        $allVehicleTypes = Vehicle::pluck('type')->unique();
        $allTransmissions = Vehicle::pluck('transmission')->unique();
    
        // Handle sorting based on the 'sort' request value
        if ($req->get('sort') == 'price-ascending') {
            // Sort vehicles by price in ascending order
            $vehicles = $vehicles->orderBy('daily_rate', 'asc')->get();
        } elseif ($req->get('sort') == 'price-descending') {
            // Sort vehicles by price in descending order
            $vehicles = $vehicles->orderBy('daily_rate', 'desc')->get();
        } else {
            // Get all vehicles if no sorting is selected
            $vehicles = $vehicles->get();
        }
    
        // Return the view with the sorted vehicles
        return view('website.ourFleet', compact('vehicles', 'allVehicleTypes', 'allTransmissions'));
    }
   
    public function filterVehicle(Request $request)
    {
        // Get all unique vehicle types and transmissions
        $allVehicleTypes = Vehicle::pluck('type')->unique();
        $allTransmissions = Vehicle::pluck('transmission')->unique();
    
        // Get the selected vehicle types and transmissions from the request
        $selectedTypes = $request->input('types', []);
    
        // Start with a query for all vehicles
        $vehiclesQuery = Vehicle::query();
    
        // Apply type and transmission filters if selected
        if (!empty($selectedTypes)) {
            $vehiclesQuery->whereIn('type', $selectedTypes);
        }
    
        // Get the selected transmissions from the request
        $selectedTransmissions = $request->input('transmissions', []);
    
        if (!empty($selectedTransmissions)) {
            $vehiclesQuery->whereIn('transmission', $selectedTransmissions);
        }
    
        // Execute the query to get filtered vehicles
        $vehicles = $vehiclesQuery->get();
    
        // Return the view with the filtered vehicles and the full filter lists
        return view('website.ourFleet', compact('vehicles', 'allVehicleTypes', 'allTransmissions'));
    }
    

    


    
}

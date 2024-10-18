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

        return view ('website.ourFleet', compact('vehicles', 'allVehicleTypes'));
    }

    public function sortVehiclePrice(Request $req)
    {
        // Default query to retrieve all vehicles
        $vehicles = Vehicle::query();
        $allVehicleTypes = Vehicle::pluck('type')->unique();
    
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
        return view('website.ourFleet', compact('vehicles', 'allVehicleTypes'));
    }
   
    public function filterVehicle(Request $request)
    {
    // Get all unique vehicle types (for the filter list)
    $allVehicleTypes = Vehicle::pluck('type')->unique();

    // Get the selected vehicle types from the request (array of types)
    $selectedTypes = $request->input('types', []);

    // Check if any vehicle types were selected
    if (!empty($selectedTypes)) {
        // Filter the vehicles by the selected types
        $vehicles = Vehicle::whereIn('type', $selectedTypes)->get();
    } else {
        // If no type is selected, return all vehicles
        $vehicles = Vehicle::all();
    }

    // Return the view with the filtered vehicles and the full filter list
    return view('website.ourFleet', compact('vehicles', 'allVehicleTypes'));
    }

    


    
}

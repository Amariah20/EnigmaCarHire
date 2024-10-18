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
        return view ('website.ourFleet', compact('vehicles'));
    }

    public function sortVehiclePrice(Request $req)
    {
        // Default query to retrieve all vehicles
        $vehicles = Vehicle::query();
    
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
        return view('website.ourFleet', compact('vehicles'));
    }
    


    
}

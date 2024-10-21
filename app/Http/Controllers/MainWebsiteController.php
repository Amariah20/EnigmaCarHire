<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class MainWebsiteController extends Controller
{



    public function logout(Request $request)

   
    {

       

        Auth::guard('customers')->logout();
       
        return redirect('/homepage'); // Change this to your desired path after logout
    }


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

    
    public function showAvailableVehicles(Request $req){

        $today = Carbon::now(); // Get today's date
        $pick_up_date = Carbon::parse($req->collection);
        $return_date = Carbon::parse($req->return);



        if ($pick_up_date->isBefore($today)) {
            return redirect()->back()->withErrors(['error' => 'Pick-up date cannot be in the past'])->withInput();
        }
    
        if ($return_date->isBefore($today)) {
            return redirect()->back()->withErrors(['error' => 'Return date cannot be in the past'])->withInput();
        }
    
            // Ensure that the return date is after the pickup date
            if (!$return_date->greaterThanOrEqualTo($pick_up_date)) {

                return redirect()->back()->withErrors(['error' => 'Return date must be after or on the same day as pickup date']) ->withInput();
            }


              

                // Step 1: Get all vehicle IDs that are reserved during the selected dates
                $reservedVehicles = Reservation::where(function ($query) use ($pick_up_date, $return_date) {
                    $query->where('return', '>=', $pick_up_date) // Reservation ends after or on pick-up date
                        ->where('pick_up', '<=', $return_date)
                        ->where('status', '!=', 'cancelled');// Reservation starts before or on return date
                })->pluck('vehicle_id'); // Get the list of reserved vehicle IDs








                $pick_up_date_check = Carbon::parse($req->collection)->subDay();


                // Check for maintenance schedules
                $maintenanceSchedule = Maintenance::where(function($query) use ($pick_up_date_check, $return_date){
                $query->where('status', '!=', 'completed') // Exclude completed maintenance
                    ->where('status', '!=', 'cancelled') // Exclude cancelled maintenance
                    ->where('due_date', '>=', $pick_up_date_check)
                    ->where('due_date', '<=', $return_date);
                })->pluck('vehicle_id');


                $excludedVehicles = $reservedVehicles->merge($maintenanceSchedule);


                $vehicles = Vehicle::whereNotIn('vehicle_id', $excludedVehicles)->get();

                // Return the available vehicles to your view or as a response
                return view('website.availableVehicles', compact('vehicles'));
          
    
    }


    public function bookVehicle(Request $request){

    
       


        
        // Check if user is logged in
    if(!Auth::guard('customers')->check()){

       

       

        session(['url.intended' => url()->previous()]);


        
        // If not logged in, redirect to login, and Laravel will handle showing the login form
        return redirect()->route('login');
    }

    // Store booking details in session to continue after login
    session([
        'vehicle_id' => $request->vehicle_id,
        'pick_up_date' => $request->collection,
        'return_date' => $request->return,
    ]);

    // If user is logged in, proceed to the next step 
    return redirect()->route('addOns');
    


    }


    public function addOns (Request $req){

        return view ('website.addOns');


    }




    


    
}

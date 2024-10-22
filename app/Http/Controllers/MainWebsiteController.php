<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Reservation;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\AdditionalDriver;
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
        $pick_up_date = Carbon::parse($req->pick_up_date);
        $return_date = Carbon::parse($req->return_date);



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








                $pick_up_date_check = Carbon::parse($req->pick_up_date)->subDay();


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
                return view('website.availableVehicles', compact('vehicles', 'pick_up_date', 'return_date'));
          
    
    }


    public function addOns(Request $request)
    {   

        
        // Check if user is logged in
    if(!Auth::guard('customers')->check()){

        session(['url.intended' => url()->previous()]);


        // If not logged in, redirect to login, and Laravel will handle showing the login form
        return redirect()->route('login');
    }

    // Store booking details in session to continue after login
    session([
        'vehicle_id' => $request->vehicle_id,
        'pick_up_date' => $request->pick_up_date,
        'return_date' => $request->return_date,
        
    ]);


    $vehicle_id = $request->vehicle_id;
    $pick_up_date  =  $request->pick_up_date;
    $return_date = $request->return_date;



    // If user is logged in, proceed to the next step 

    
   
    return view('website.addOns', compact('vehicle_id', 'pick_up_date', 'return_date'));

    


    }


    public function payment(Request $request)
    {

        

        

         // Store additional driver details if 'additional_driver' is selected
        $additional_driver = in_array('additional_driver', $request->add_ons ?? []);

        
        if ($additional_driver) {

            if($request->driver_name==null || $request->license_number ==null || $request->issuing_country==null){

               
                return redirect()->back()
                ->withErrors(['error' => 'Driver name, License Number, and Issuing Country are required when adding an additional driver'])
                ->withInput(); // Send old input back to the view
               
            
            } else{

                $additional_driver_name = $request->driver_name;
                $additional_license_number = $request->license_number;
                $additional_issuing_country = $request->issuing_country;
                
            }

        }else{

            $additional_driver_name = null;
            $additional_license_number = null;
            $additional_issuing_country = null;


        }

        if (!$additional_driver && ($request->driver_name || $request->license_number || $request->issuing_country)) {
            return redirect()->back()
                ->withErrors(['error' => 'Please tick the "Additional Driver" box if you wish to enter driver details.'])
                ->withInput();
        }
    

   
    // Check if 'child_seat' is selected
    $child_seat = in_array('child_seat', $request->add_ons ?? []) ? 'Yes' : 'No'; //Might change when childseat info is updated in admin panel?? 
    

    
    $vehicle_id = $request->vehicle_id;
    $pick_up_date = $request->pick_up_date;
    $return_date = $request->return_date;

    return view ('website.payment', compact('additional_driver_name', 'additional_license_number', 'additional_issuing_country', 'child_seat', 'vehicle_id', 'pick_up_date', 'return_date'));

}


public function confirm(Request $req){

        // Validate that the checkbox for accepting terms is checked
        if (!$req->has('accept_terms')) {
            return redirect()->back()
                ->withErrors(['error' => 'You must accept the rental terms and conditions.'])
                ->withInput(); // This keeps the previous input in the form
        }

        
        // Validate that a payment type is selected
        if (!$req->has('payment_type')) {
            return redirect()->back()
                ->withErrors(['error' => 'You must choose a payment type.'])
                ->withInput();
        }


        $vehicle_id = $req->vehicle_id;    
        $pick_up_date = Carbon::createFromFormat('Y-m-d H:i:s', $req->pick_up_date);
        $return_date = Carbon::createFromFormat('Y-m-d H:i:s', $req->return_date);
        $payment_type= $req->payment_type;
        $additional_driver_name = $req->additional_driver_name;
        $additional_license_number = $req->additional_license_number;
        $additional_issuing_country = $req->additional_issuing_country;

       
        
        if($req-> child_seat=='Yes'){
            $child_seat = 1;
        }else{
            $child_seat =0;
        }

        $user = Auth::guard('customers')->user();

        $vehicle= Vehicle::where('vehicle_id', $vehicle_id)->first();
        $rental_days = $pick_up_date->diffInDays($return_date) + 1; // +1 to include the pickup day
        $total_price = $rental_days * $vehicle->daily_rate;


        if($payment_type=="full_payment"){
            $total_paid= $total_price;
            $payment_status = "paid";

        } elseif ($payment_type=="deposit"){
            $total_paid = round($total_price / 2, 2); // Rounds to 2 decimal places
            $payment_status= "partially-paid";
        } else{
            $total_paid= 0;
            $payment_status = "not-paid"; // Not paid

        }
        
        //STORE RESERVATION DETAIL

        $reservation = new Reservation();
        $reservation->pick_up = $pick_up_date;
        $reservation->return = $return_date;
        $reservation->total_price = $total_price;
        $reservation->status ='confirmed';
        $reservation->vehicle_id = $vehicle_id;
        $reservation -> customer_id = $user->customer_id;
        $reservation->child_seat = $child_seat;
        $reservation->reservation_date = now()->toDateString();

        $reservation->save();

        $reservation_id= $reservation->reservation_id;

        //STORE PAYMENT DETAIL (RESERVATION_ID FOREIGN KEY)

        $payment = new Payment();
        $payment->total_price =$total_price;
        $payment->total_paid = $total_paid;
        $payment->payment_date = now()->toDateString();
        $payment->status = $payment_status;
        $payment->reservation_id = $reservation_id;

        $payment->save();


        //STORE ADDITIONAL DRIVER DETAIL (RESERVATION_ID FOREIGN KEY)


        if ($additional_driver_name !== null && $additional_license_number !== null && $additional_issuing_country !== null) {

            $additional_driver = new AdditionalDriver();
            $additional_driver->name = $additional_driver_name;
            $additional_driver->license_number = $additional_license_number;
            $additional_driver ->issuing_country = $additional_issuing_country;
            $additional_driver->reservation_id = $reservation_id;
            
            $additional_driver->save();
        }


        return redirect('/homepage')->with('success', 'Reservation created successfully!');


}





    


    
}

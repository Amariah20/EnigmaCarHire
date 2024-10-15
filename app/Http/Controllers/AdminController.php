<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function show(){

        return view('admin-panel.dashboard');
    }

    public function showVehicles(){

        $vehicles = Vehicle::all();
        return view('admin-panel.vehicles', compact('vehicles'));
    }

    public function addvehicle(){
        return view ('admin-panel.addVehicle');
    }

    public function storeVehicle(Request $req){

        $vehicle = new \App\Models\Vehicle();
        $vehicle->vehicle_name = $req->vehiclename;
        $vehicle->make_model = $req->makemodel;
        $vehicle->license_plate = $req->license;
        $vehicle->type = $req->type;
        $vehicle->transmission = $req->transmission;
        $vehicle->status = 'available'; //automatically set to avaialble when car is newly added
        $vehicle->daily_rate = $req->dailyrate;
        
        if($req->hasfile('image')){
            $file = $req->image;
            $extension = $file->getClientOriginalExtension();
            $filename = time().$req->license.'.'.$extension;
            $file->move('public/vehicles', $filename);
            $vehicle->image = $filename;
        }

        $vehicle->save();
        return redirect()->route('vehicles')->with('success', 'Vehicle Added Successfully');

    }

    public function editVehicle(Request $req, $vehicle_id){

        $vehicle= Vehicle::where('vehicle_id', $vehicle_id)->first();
      

        return view('admin-panel.editVehicle', compact('vehicle'));

    }

    public function storeEditVehicle(Request $req, $vehicle_id){

        $vehicle= Vehicle::where('vehicle_id', $vehicle_id)->first();
        $vehicle->vehicle_name = $req->vehiclename;
        $vehicle->make_model = $req->makemodel;
        $vehicle->license_plate = $req->license;
        $vehicle->type = $req->type;
        $vehicle->transmission = $req->transmission;
        $vehicle->status = $req->status; 
        $vehicle->daily_rate = $req->dailyrate;
        
        if($req->hasfile('image')){
            $file = $req->image;
            $extension = $file->getClientOriginalExtension();
            $filename = time().$req->license.'.'.$extension;
            $file->move('public/vehicles', $filename);
            $vehicle->image = $filename;
        }

        $vehicle->update();

        return redirect()->route('vehicles')->with('success', 'Vehicle Edited Successfully');

    }

    public function deleteVehicle($vehicle_id){

        $vehicle= Vehicle::where('vehicle_id', $vehicle_id);
        $vehicle->delete();

        return redirect()->route('vehicles')->with('success', 'Vehicle Deleted Successfully');



    }

    public function showReservations(){

        $reservations = Reservation::with('vehicle','customer')->get();
        return view('admin-panel.reservations', compact('reservations'));
    }

    public function editReservation($reservation_id){

        $reservation= Reservation::where('reservation_id', $reservation_id)->first();
        $vehicles = Vehicle::all();
      

        return view('admin-panel.editReservation', compact('reservation', 'vehicles'));



    }

    /**public function storeEditReservation(Request $req, $reservation_id){

        $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        $reservation->vehicle_id = $req->vehicle_id;
        $reservation->total_price = $req->total_price;
        $reservation->pick_up = $req->collection;
        $reservation->return = $req->return;
        $reservation->status = $req->status;

        

        $reservation->update();

        return redirect()->route('reservations')->with('success', 'Reservation Edited Successfully');


        

    }*/
    
    public function storeEditReservation(Request $req, $reservation_id){

        
        $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        
        
        $reservation->vehicle_id = $req->vehicle_id;
        $reservation->pick_up = $req->collection;
        $reservation->return = $req->return;
        $reservation->status = $req->status;
        
        // Fetch the vehicle to get the daily_rate
        $vehicle = Vehicle::where('vehicle_id', $req->vehicle_id)->first();

        // Check if both pick_up and return dates are provided and valid
        if ($vehicle && $req->collection && $req->return) {
            // Parse the collection and return dates using Carbon
            $pick_up_date = Carbon::parse($req->collection);
            $return_date = Carbon::parse($req->return);

            // Ensure that the return date is after the pickup date
            if ($return_date->greaterThanOrEqualTo($pick_up_date)) {
                // Calculate the difference in days between pick_up and return dates
                $rental_days = $pick_up_date->diffInDays($return_date) + 1; // +1 to include the pickup day
                
                // Calculate the total price by multiplying daily rate and rental days
                $reservation->total_price = $rental_days * $vehicle->daily_rate;
            } else {
                // Handle the case where return date is before pick_up (this shouldn't happen)
                return redirect()->back()->withErrors(['error' => 'Return date must be after or on the same day as pickup date']);
            }
        } else {
            // If dates are not provided, keep the existing total_price
            $reservation->total_price = $req->total_price;
        }

        // Save the updated reservation
        $reservation->update();

        // Redirect back to reservations with success message
        return redirect()->route('reservations')->with('success', 'Reservation Edited Successfully');
    }

    



}

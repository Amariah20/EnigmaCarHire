<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

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

        return redirect()->back()->with('success', 'Vehicle Edited Successfully');

    }

    public function deleteVehicle($vehicle_id){

        $vehicle= Vehicle::where('vehicle_id', $vehicle_id);
        $vehicle->delete();

        return redirect()->back()->with('success', 'Vehicle Deleted Successfully');



    }

    public function showReservations(){

        $reservations = Reservation::with('vehicle','customer', 'additionalDriver')->get();
        return view('admin-panel.reservations', compact('reservations'));
    }

    public function editReservation($reservation_id){

        $reservation= Reservation::where('reservation_id', $reservation_id)->first();
        $vehicles = Vehicle::all();
      

        return view('admin-panel.editReservation', compact('reservation', 'vehicles'));



    }

  
    
    public function storeEditReservation(Request $req, $reservation_id){

        
        //$reservation = Reservation::where('reservation_id', $reservation_id)->first();
        $reservation = Reservation::with('additionalDriver')->where('reservation_id', $reservation_id)->first();
    
        
        
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


        // Check if an additional driver exists and update the name
    if ($reservation->additionalDriver) {
        $additionalDriver = $reservation->additionalDriver;
        $additionalDriver->name = $req->additional_driver; // Use the input from the form
        $additionalDriver->save(); // Save the updated additional driver
    }


        // Redirect back to reservations with success message
        return redirect()->back()->with('success', 'Reservation Edited Successfully');
    }

    public function deleteReservation($reservation_id){

        $reservation= Reservation::where('reservation_id', $reservation_id);
        $reservation->delete();

        return redirect()->back()->with('success', 'Reservation Deleted Successfully');


    }

    public function showPayments(){

        $payments = Payment::with('reservation')->get();

        $totalPrice = $payments->sum(function($payment) {
            return $payment->reservation ? $payment->reservation->total_price : 0;
        });
    
        $totalPaid = $payments->sum('total_paid');

        return view('admin-panel.payments', compact('payments', 'totalPrice', 'totalPaid'));

         
    }

    public function editPayment($payment_id){

        

        //When a change to total price occurs in reservation tab, it is reflected in payments.
        $payment=Payment::where('payment_id', $payment_id)->first();

        return view('admin-panel.editPayment', compact('payment'));



    }

    public function storeEditPayment(Request $req, $payment_id){

        

        $payment= Payment::where('payment_id', $payment_id)->first();

        

        $payment->total_paid= $req->total_paid;
        $payment->status = $req->status;
        $payment->payment_date = $req->payment_date;

        $payment->update();

        return redirect()->back()->with('success', 'Payment Edited Successfully');

    }


    //when admin clicks on reservation ID from payments tab, this controller is run
    public function viewReservation($reservation_id) { 

        
        $reservation = Reservation::with('additionalDriver', 'payment')->where('reservation_id', $reservation_id)->first();

        //$reservation = Reservation::find($reservation_id);
    
        if (!$reservation) {
            return redirect()->back()->withErrors('Reservation not found.');
        }

        $payment = $reservation->payment;
    
        return view('admin-panel.viewReservation', compact('reservation', 'payment'));
    }
    

    public function showMaintenances(){
        $maintenances = Maintenance::all();

        $totalPrice = $maintenances->sum('price');
        return view ('admin-panel.maintenances', compact('maintenances', 'totalPrice'));
    }

    public function addMaintenance()
    {
        $vehicles = Vehicle::all(); // Fetch all vehicles from the database
        return view('admin-panel.addMaintenance', compact('vehicles')); // Pass the vehicles to the view
    }

    public function storeMaintenance(Request $req){


        $req->validate([
             'due_date' => 'required|date|unique:maintenances,due_date', // Ensure unique due_date across all maintenance records
        ]);

        $maintenance= new \App\Models\Maintenance();
        $maintenance->vehicle_id = $req->vehicle_id;
        $maintenance->maintenance_type = $req->maintenance_type;
        $maintenance->description = $req->description;
        $maintenance->due_date = $req->due_date;
        $maintenance->price = $req->price;
        $maintenance->status = $req->status;

        $maintenance->save();

        return redirect()->back()->with('success', 'Maintenance Added Successfully');


    }

    public function editMaintenance($maintenance_id){

        $maintenance= Maintenance::where('maintenance_id', $maintenance_id)->first();
        $vehicles = Vehicle::all();
      

        return view('admin-panel.editMaintenance', compact('maintenance', 'vehicles'));

    }

    public function storeEditMaintenance(Request $req, $maintenance_id){

        $maintenance= Maintenance::where('maintenance_id', $maintenance_id)->first();


         // Initialize the validation rules array
        $validationRules = [];

        // Check if the due date has been changed
        if ($req->has('due_date') && $req->due_date !== $maintenance->due_date) {
        // Add the unique rule for due_date if it has been changed
        $validationRules['due_date'] = [
            'required',
            'date',
            Rule::unique('maintenances')->where(function ($query) use ($maintenance) {
                return $query->where('maintenance_id', '!=', $maintenance->maintenance_id); // Exclude the current maintenance
            }),
        ];
    } else {
        // If the due date has not changed, we can keep it required and date
        $validationRules['due_date'] = 'required|date';
    }

    // Validate the request with the defined rules
    $req->validate($validationRules);
    
    


        $maintenance->vehicle_id = $req->vehicle_id;
        $maintenance->maintenance_type = $req->maintenance_type;
        $maintenance->description = $req->description;
        $maintenance->due_date = $req->due_date;
        $maintenance->price = $req->price;
        $maintenance->status = $req->status;

        $maintenance->update();



        // Update the vehicle status based on the maintenance status
        $vehicle = Vehicle::where('vehicle_id', $maintenance->vehicle_id)->first();



        if ($req->status === 'In progress') {
            // If maintenance is "in progress", set the vehicle status to "in service"
            $vehicle->status = 'in service';
            
        } elseif ($req->status === 'completed' || $req->status === 'Upcoming' || $req->status === 'Cancelled') {
            // If maintenance is "completed" or "upcoming", set the vehicle status to "available"
            $vehicle->status = 'available';
            
           
        }

        // Save the updated vehicle status
        $vehicle->update();

        return redirect()->back()->with('success', 'Maintenance Edited Successfully');

    }

    public function deleteMaintenance($maintenance_id){

        $maintenance= Maintenance::where('maintenance_id', $maintenance_id);
        $maintenance->delete();

        return redirect()->back()->with('success', 'Maintenance Deleted Successfully');



    }


}

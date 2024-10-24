<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Insurance;
use App\Models\Customer;
use App\Models\AdditionalDriver;
use App\Models\RentalTerm;
use App\Models\Extra;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function show(){


        //to show outstanding payment on dashboard
        //Must ensure not to include records where reservation was cancelled
       
       // Fetch payments where status is partially-paid or not-paid
         $payments = Payment::whereIn('status', ['partially-paid', 'not-paid'])->get();

         $total_price = $payments->sum('total_price');
         $total_paid = $payments->sum('total_paid');
        
         

          // Calculate total outstanding payments
         $OutstandingPayments = $total_price - $total_paid;



        $currentDate = Carbon::now();
    
        // Get the date 7 days from now
        $nextWeekDate = Carbon::now()->addDays(7);
        
        // Fetch maintenance records with due_date between now and next week
            $MaintenenacedueNextWeek = Maintenance::whereBetween('due_date', [$currentDate, $nextWeekDate])
                                     ->whereNotIn('status', ['completed', 'in progress', 'Cancelled']) 
                                     ->get();

            $InsurancedueNextWeek = Insurance::whereBetween('due_date', [$currentDate, $nextWeekDate])
                                    ->whereNotIn('status', ['completed', 'Cancelled']) 
                                    ->get();                       

         $vehicles = Vehicle::all();
      


        return view('admin-panel.dashboard', compact('MaintenenacedueNextWeek', 'vehicles', 'OutstandingPayments', 'InsurancedueNextWeek'));
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
        $reservation->child_seat = $req->child_seat;
        
        // Fetch the vehicle to get the daily_rate
        $vehicle = Vehicle::where('vehicle_id', $req->vehicle_id)->first();


        $pick_up_date = Carbon::parse($req->collection);
        $return_date = Carbon::parse($req->return);

        // Check if both pick_up and return dates are provided and valid
        if ($vehicle && $req->collection && $req->return) {
            // Parse the collection and return dates using Carbon
           

            // Ensure that the return date is after the pickup date
            if ($return_date->greaterThanOrEqualTo($pick_up_date)) {
                // Calculate the difference in days between pick_up and return dates
                $rental_days = $pick_up_date->diffInDays($return_date) + 1; // +1 to include the pickup day
                
                // Calculate the total price by multiplying daily rate and rental days
                $reservation->total_price = $rental_days * $vehicle->daily_rate;
            } else {
                // Handle the case where return date is before pick_up (this shouldn't happen)
                return redirect()->back()->withErrors(['error' => 'Return date must be after or on the same day as pickup date']) ->withInput();
            }
        } else {
            // If dates are not provided, keep the existing total_price
            $reservation->total_price = $req->total_price;
        }


        
            
         
            // ** Check for conflicting reservations or maintenance schedules ** //
            $existingReservation = Reservation::where('vehicle_id', $req->vehicle_id)
            ->where('reservation_id', '!=', $reservation_id) // Exclude the current reservation
            ->where(function ($query) use ($pick_up_date, $return_date) {
                // Check if the vehicle is reserved on the same day as pick-up or overlapping dates
                $query->where(function ($q) use ($pick_up_date) {
                    // Vehicle cannot be picked up on the same day it is returned
                    $q->where('return', '>=', $pick_up_date);
                })
                ->where(function ($q) use ($return_date) {
                    // Vehicle cannot be returned before the new pick-up date
                    $q->where('pick_up', '<=', $return_date);
                });
            })->exists();

           

            $pick_up_date_check = Carbon::parse($req->collection)->subDay();


            // Check for maintenance schedules for the selected vehicle
            $maintenanceSchedule = Maintenance::where('vehicle_id', $req->vehicle_id)
            ->where('status', '!=', 'completed') // Exclude completed maintenance
            ->where('status', '!=', 'cancelled') // Exclude cancelled maintenance
            ->where(function ($query) use ($pick_up_date_check, $return_date) {
                // Maintenance due dates should be on or between the rental dates
                $query->where(function ($q) use ($pick_up_date_check, $return_date) {
                    // Maintenance cannot be due within the rental period
                    // Vehicle cannot be returned on or after the maintenance due date
                    $q->where('due_date', '>=', $pick_up_date_check)
                    ->where('due_date', '<=', $return_date);
                });
            })->exists();

            // If the vehicle is already reserved or undergoing maintenance, return an error
            if ($existingReservation || $maintenanceSchedule) {
            return redirect()->back()->withErrors(['error' => 'The vehicle is not available for the selected dates.']) ->withInput();
            }


                    
                

        
        // Save the updated reservation
        $reservation->update();


        // Check if an additional driver exists and update the name
    if ($reservation->additionalDriver) {
        $additionalDriver = $reservation->additionalDriver;
        $additionalDriver->name = $req->additional_driver; // Use the input from the form
        $additionalDriver->update(); // Save the updated additional driver
    }


      // Fetch the associated payment
      $payment = Payment::where('reservation_id', $reservation_id)->first();

        // Logic for automatically updating payment status based on reservation and payment amounts
    if ($reservation->status == 'cancelled') {
        if ($payment) {
            // Automatically set payment status to 'cancelled' if reservation is cancelled
            $payment->status = 'cancelled';
            
        }
    } else {
        // If reservation status is changed from 'cancelled' to 'confirmed' or 'completed', update the payment status
        if ($payment) {
            $total_price = $reservation->total_price;
            $total_paid = $payment->total_paid;

            if ($total_paid == $total_price) {
                $payment->status = 'paid'; // Fully paid
            } elseif ($total_paid > 0 && $total_paid < $total_price) {
                $payment->status = 'partially-paid'; // Partially paid
            } elseif ($total_paid == 0) {
                $payment->status = 'not-paid'; // Not paid
            }

           
        }
    }


        $payment->total_price = $req->total_price;
        $payment->update();


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

             // Check if the payment status is "cancelled"
             if ($payment->status == 'cancelled') {
                // Redirect back with an error message
                return redirect()->back()->withErrors(['error' => 'You cannot edit a payment record that is associated with a cancelled reservation.']) ->withInput();
                }

        return view('admin-panel.editPayment', compact('payment'));



    }

    public function storeEditPayment(Request $req, $payment_id){

        

        $payment= Payment::where('payment_id', $payment_id)->first();
       
    


        $payment->total_paid= $req->total_paid;
        $payment->payment_date = $req->payment_date;

        $reservation= Reservation::where('reservation_id', $req->reservation_id)->first();

        if ($reservation->status == 'cancelled') {
            
                // Automatically set payment status to 'cancelled' if reservation is cancelled
                $payment->status = 'cancelled';
                
            
        } else {
            
                $total_price = $req->total_price;
                $total_paid = $req->total_paid;
    
                if ($total_paid == $total_price) {
                    $payment->status = 'paid'; // Fully paid
                } elseif ($total_paid > 0 && $total_paid < $total_price) {
                    $payment->status = 'partially-paid'; // Partially paid
                } elseif ($total_paid == 0) {
                    $payment->status = 'not-paid'; // Not paid
                }
    
               
            }
        
    




        $payment->update();

        return redirect()->back()->with('success', 'Payment Edited Successfully');

    }


    //when admin clicks on reservation ID from payments tab, this controller is run
    public function viewReservation($reservation_id) { 

        
        $reservation = Reservation::with('additionalDriver', 'payment')->where('reservation_id', $reservation_id)->first();

        //$reservation = Reservation::find($reservation_id);
    
        if (!$reservation) {
            return redirect()->back()->withErrors('Reservation not found.') ->withInput();
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


        if($req->status !== 'completed' && $req->status !== 'cancelled'){

            $req->validate([
                'due_date' => 'required|date|unique:maintenances,due_date', // Ensure unique due_date across all maintenance records
            ]);
        }



        ///LOGIC TO PREVENT MAINTENANCE DURING RENTED PERIOD. Unless maintenance has been cancelled or completed. 

        if($req->status !== 'completed' && $req->status !== 'cancelled'){

            $due_date = Carbon::parse($req->due_date)->toDateString();

           

         
             $existingReservations = Reservation::where('vehicle_id', $req->vehicle_id)
                            ->select('pick_up', 'return')
                            ->get();
                            
                    
                            
            foreach ($existingReservations as $reservation) {
            $pick_up_date = Carbon::parse($reservation->pick_up)->toDateString();
            $return_date = Carbon::parse($reservation->return)->toDateString();


           
           


            if($due_date == $pick_up_date || $due_date == $return_date){

                

                return redirect()->back()->withErrors(['error'=> 'The vehicle is not available for maintenance during the selected date.'])->withInput();
            } else if ($due_date >= $pick_up_date && $due_date<= $return_date){
                return redirect()->back()->withErrors(['error'=> 'The vehicle is not available for maintenance during the selected date.'])->withInput();

            }
        
        
       
        
        }

    }

           

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

        if($req->status !== 'completed' && $req->status !== 'Cancelled'){

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

}



             ///LOGIC TO PREVENT MAINTENANCE DURING RENTED PERIOD. Unless maintenance has been cancelled or completed. 

        if($req->status !== 'completed' && $req->status !== 'Cancelled'){

            $due_date = Carbon::parse($req->due_date)->toDateString();

           

         
             $existingReservations = Reservation::where('vehicle_id', $req->vehicle_id)
                            ->select('pick_up', 'return')
                            ->get();
                            
                    
                            
            foreach ($existingReservations as $reservation) {
            $pick_up_date = Carbon::parse($reservation->pick_up)->toDateString();
            $return_date = Carbon::parse($reservation->return)->toDateString();


           
           


            if($due_date == $pick_up_date || $due_date == $return_date){

                

                return redirect()->back()->withErrors(['error'=> 'The vehicle is not available for maintenance during the selected date.']) ->withInput();
            } else if ($due_date >= $pick_up_date && $due_date<= $return_date){
                return redirect()->back()->withErrors(['error'=> 'The vehicle is not available for maintenance during the selected date.']) ->withInput();

            }
        
        
       
        
        }

    }


      
        $maintenance->vehicle_id = $req->vehicle_id;
        $maintenance->maintenance_type = $req->maintenance_type;
        $maintenance->description = $req->description;
        $maintenance->due_date = $req->due_date;
        $maintenance->price = $req->price;
        $maintenance->status = $req->status;

        $maintenance->update();



        // Update the vehicle status based on the maintenance status
        $vehicle = Vehicle::where('vehicle_id', $maintenance->vehicle_id)->first();

        if ($vehicle->status != 'rented'){

        if ($req->status === 'In progress') {
            // If maintenance is "in progress", set the vehicle status to "in service"
            $vehicle->status = 'in service';
            
        } elseif ($req->status === 'completed' || $req->status === 'Upcoming' || $req->status === 'Cancelled') {
            // If maintenance is "completed" or "upcoming", set the vehicle status to "available"
            $vehicle->status = 'available';
            
           
        }

        // Save the updated vehicle status
        $vehicle->update();
    }

        return redirect()->back()->with('success', 'Maintenance Edited Successfully');

    }

    public function deleteMaintenance($maintenance_id){

        $maintenance= Maintenance::where('maintenance_id', $maintenance_id);
        $maintenance->delete();

        return redirect()->back()->with('success', 'Maintenance Deleted Successfully');



    }


    public function showInsurances(){
        $insurances= Insurance::all();
        $totalPrice = $insurances->sum('price');
        return view('admin-panel.insurances', compact('insurances', 'totalPrice'));
    }

    public function addInsurance(){

        $vehicles = Vehicle::all();
        return view ('admin-panel.addInsurance', compact('vehicles'));

    }

    public function storeInsurance(Request $req){


       

       $insurance= new \App\Models\Insurance();
       $insurance->vehicle_id = $req->vehicle_id;
       $insurance->due_date = $req->due_date;
 
       $insurance->price = $req->price;
       $insurance->status = $req->status;

       $insurance->save();

       return redirect()->back()->with('success', 'Insurance Added Successfully');

    }

    public function editInsurance($insurance_id){
        $insurance=Insurance::where('insurance_id', $insurance_id)->first();
        $vehicles = Vehicle::all();
      
        return view ('admin-panel.editInsurance', compact('insurance', 'vehicles'));
    }

    public function storeEditInsurance(Request $req, $insurance_id){

    
        $insurance = Insurance::where('insurance_id', $insurance_id)->first();

        $insurance->vehicle_id = $req->vehicle_id;
        $insurance->due_date = $req->due_date;

        $insurance->price = $req->price;
        $insurance->status = $req->status;

        $insurance->update();

        return redirect()->back()->with('success', 'Insurance Updated Successfully');



    }

    public function deleteInsurance($insurance_id){

      
        
        $insurance = Insurance::where('insurance_id', $insurance_id)->first();

        $insurance->delete();

        return redirect()->back()->with('success', 'Insurance Deleted Successfully');
        

    }


    public function viewVehicle($vehicle_id){

        $vehicle = Vehicle::with('reservations', 'insurances', 'maintenances')->where('vehicle_id', $vehicle_id)->first();
        $reservations = $vehicle->reservations; 
        $insurances =$vehicle->insurances;
        $maintenances =$vehicle->maintenances;
        $totalInsurance = $insurances->sum('price');
        $totalMaintenance = $maintenances->sum('price');
      

        // Pass the vehicle data to the view
        return view('admin-panel.viewVehicle', compact('vehicle', 'reservations', 'insurances', 'maintenances', 'totalInsurance', 'totalMaintenance'));
    }


    public function showCustomers(){

        $customers = Customer::all();
        return view('admin-panel.customers', compact('customers'));
    }

    public function showadditionalDrivers(){

        $additionalDrivers = AdditionalDriver::all();
        return view ('admin-panel.additionalDrivers', compact('additionalDrivers'));
    }



    public function showTerms(){

        $terms = RentalTerm :: all();

        return view ('admin-panel.rentalTerms', compact('terms'));
    }

    public function addRentalTerm(){

        return view ('admin-panel.addRentalTerm');
    }

    public function storeRentalTerm(Request $req){

        $rental_term = new RentalTerm();
        $rental_term->rental_terms = $req->rental_term;
        $rental_term->save();

        return redirect()->back()->with('success', 'Rental Condition Added Successfully');


    }

    public function deleteRentalTerm($rental_terms_id){

        $rental_term = RentalTerm::where('rental_terms_id', $rental_terms_id)->first();

        $rental_term->delete();

        return redirect()->back()->with('success', 'Rental Condition Deleted Successfully');

    }


    public function editRentalTerm($rental_terms_id){
        $rental_term = RentalTerm::where('rental_terms_id', $rental_terms_id)->first();
      
        return view ('admin-panel.editRentalTerm', compact('rental_term'));
    }

    public function storeEditRentalTerm(Request $req, $rental_terms_id){

        $rental_term = RentalTerm::where('rental_terms_id', $rental_terms_id)->first();


        $rental_term -> rental_terms = $req->rental_term;

        $rental_term->update();

        return redirect()->back()->with('success', 'Rental Condition Updated Successfully');


    }


    public function showExtras(){

        $extras = Extra::all();

        return view ('admin-panel.extras', compact('extras'));
    }


    public function addExtra(){

        return view ('admin-panel.addExtra');
    }

    public function storeExtra(Request $req){

        $extra = new Extra();
        $extra->extra_name = $req->extra_name;
        $extra->price= $req->price;
        $extra->save();

        return redirect()->back()->with('success', 'Additional Item Added Successfully');


    }


    public function editExtra($extra_id){
        $extra = Extra::where('extra_id', $extra_id)->first();
      
        return view ('admin-panel.editExtra', compact('extra'));
    }

    public function storeEditExtra(Request $req, $extra_id){

        $extra = Extra::where('extra_id', $extra_id)->first();


        $extra -> extra_name = $req->extra_name;
        $extra->price =$req->price;

        $extra->update();

        return redirect()->back()->with('success', 'Additional Item Updated Successfully');


    }


    public function deleteExtra($extra_id){

        $extra= Extra::where('extra_id', $extra_id)->first();

       /** if ($extra->extra_name == 'Additional Driver') {
            return redirect()->back()->withErrors(['error' => 'You cannot delete the "Additional Driver" extra.']);
        }*/

        $extra->delete();

        return redirect()->back()->with('success', 'Additional Item Deleted Successfully');

    }



}

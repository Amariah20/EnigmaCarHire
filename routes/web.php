<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FilterSortController;
use App\Http\Controllers\MainWebsiteController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/logout', [MainWebsiteController::class, 'logout'])->name('logout'); 


Route::get('/addCustomer', [CustomerController::class, 'addCustomer'])->name('addCustomer');
Route::post('/storeCustomer',[CustomerController::class, 'storeCustomer'])->name('storeCustomer');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//add admin middleware later
Route::get('/dashboard', [AdminController::class, 'show'])->name('dashboard');
Route::get('/vehicles', [AdminController::class, 'showVehicles'])->name('vehicles');
Route::get('/AddVehicle', [AdminController::class, 'addvehicle'])->name('AddVehicle');
Route::post('/storeVehicle', [AdminController::class, 'storeVehicle'])->name('storeVehicle');
Route::get('/editVehicle/{vehicle_id}',[AdminController::class, 'editVehicle'])->name('editVehicle');
Route::post('/storeEditVehicle/{vehicle_id}', [AdminController::class, 'storeEditVehicle'])->name('storeEditVehicle');
Route::get('/deleteVehicle/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('deleteVehicle');

Route::get('/reservations', [AdminController::class, 'showReservations'])->name('reservations');
Route::get('/editReservation/{reservation_id}', [AdminController::class, 'editReservation'])->name('editReservation');
Route::post('/storeEditReservation/{reservation_id}', [AdminController::class, 'storeEditReservation'])->name('storeEditReservation');
Route::get('/deleteReservation/{reservation_id}', [AdminController::class, 'deleteReservation'])->name('deleteReservation');


Route::get('/payments', [AdminController::class, 'showPayments'])->name('payments');
Route::get('/editPayment/{payment_id}', [AdminController::class, 'editPayment'])->name('editPayment');
Route::post('/storeEditPayment/{payment_id}', [AdminController::class, 'storeEditPayment'])->name('storeEditPayment');

Route::get('/viewReservation/{reservation_id}', [AdminController::class, 'viewReservation'])->name('viewReservation');

Route::get('/maintenances', [AdminController::class, 'showMaintenances'])->name('maintenances');
Route::get('/addMaintenance', [AdminController::class, 'addMaintenance'])->name('addMaintenance');
Route::post('/storeMaintenance', [AdminController::class, 'storeMaintenance'])->name('storeMaintenance');
Route::get('/editMaintenance/{maintenance_id}', [AdminController::class, 'editMaintenance'])->name('editMaintenance');
Route::post('/storeEditMaintenance/{maintenance_id}', [AdminController::class, 'storeEditMaintenance'])->name('storeEditMaintenance');
Route::get('/deleteMaintenance/{maintenance_id}', [AdminController::class, 'deleteMaintenance'])->name('deleteMaintenance');

Route::get('/insurances', [AdminController::class, 'showInsurances'])->name('insurances');
Route::get('/addInsurance', [AdminController::class, 'addInsurance'])->name('addInsurance');
Route::post('/storeInsurance', [AdminController::class, 'storeInsurance'])->name('storeInsurance');
Route::get('/editInsurance/{insurance_id}', [AdminController::class, 'editInsurance'])->name('editInsurance');
Route::post('/storeEditInsurance/{insurance_id}', [AdminController::class, 'storeEditInsurance'])->name('storeEditInsurance');
Route::get('/deleteInsurance/{insurance_id}', [AdminController::class, 'deleteInsurance'])->name('deleteInsurance');


Route::get('/viewVehicle/{vehicle_id}', [AdminController::class, 'viewVehicle'])->name('viewVehicle');

Route::get('/customers', [AdminController::class, 'showCustomers'])->name('customers');
Route::get('/additionalDrivers', [AdminController::class, 'showadditionalDrivers'])->name('additionalDrivers');



Route::get('/rental_terms', [AdminController::class, 'showTerms'])->name('rental_terms');
Route::get('/addRentalTerm', [AdminController::class, 'addRentalTerm'])->name('addRentalTerm');
Route::post('/storeRentalTerm', [AdminController::class, 'storeRentalTerm'])->name('storeRentalTerm');
Route::get('/deleteRentalTerm/{rental_terms_id}', [AdminController::class, 'deleteRentalTerm'])->name('deleteRentalTerm');
Route::get('/editRentalTerm/{rental_terms_id}', [AdminController::class, 'editRentalTerm'])->name('editRentalTerm');
Route::post('/storeEditRentalTerm/{rental_terms_id}', [AdminController::class, 'storeEditRentalTerm'])->name('storeEditRentalTerm');

Route::get('/extras', [AdminController::class, 'showExtras'])->name('extras');
Route::get('/addExtra', [AdminController::class, 'addExtra'])->name('addExtra');
Route::post('/storeExtra', [AdminController::class, 'storeExtra'])->name('storeExtra');
Route::get('/deleteExtra/{extra_id}', [AdminController::class, 'deleteExtra'])->name('deleteExtra');
Route::get('/editExtra/{extra_id}', [AdminController::class, 'editExtra'])->name('editExtra');
Route::post('/storeEditExtra/{extra_id}', [AdminController::class, 'storeEditExtra'])->name('storeEditExtra');

Route::get('/locations', [AdminController::class, 'showLocations'])->name('locations');
Route::get('/addLocation', [AdminController::class, 'addLocation'])->name('addLocation');
Route::post('/storeLocation', [AdminController::class, 'storeLocation'])->name('storeLocation');
Route::get('/deleteLocation/{location_id}', [AdminController::class, 'deleteLocation'])->name('deleteLocation');
Route::get('/editLocation/{location_id}', [AdminController::class, 'editLocation'])->name('editLocation');
Route::post('/storeEditLocation/{location_id}', [AdminController::class, 'storeEditLocation'])->name('storeEditLocation');





//CUSTOMER-FACING WEBSITE
Route::get('/homepage', [MainWebsiteController::class, 'homepage'])->name('homepage');
Route::get('/ourFleet', [MainWebsiteController::class, 'ourFleet'])->name('ourFleet');


Route::get('/sortFilterAvailableVehicles', [FilterSortController::class, 'sortFilterAvailableVehicles'])->name('sortFilterAvailableVehicles');
Route::get('/sortFilterVehicle', [FilterSortController::class, 'sortAndFilterVehicles'])->name('sortFilterVehicle');
Route::get('/sortVehiclePrice', [FilterSortController::class, 'sortVehiclePrice'])->name('sortVehiclePrice');
Route::get('/filterVehicle', [FilterSortController::class, 'filterVehicle'])->name('filterVehicle');
Route::get('/filterAvailableVehicle', [FilterSortController::class, 'filterAvailableVehicle'])->name('filterAvailableVehicle');
Route::get('/sortAvailableVehiclePrice', [FilterSortController::class, 'sortAvailableVehiclePrice'])->name('sortAvailableVehiclePrice');
Route::get('/showAvailableVehicles', [MainWebsiteController::class, 'showAvailableVehicles'])->name('showAvailableVehicles');
Route::match(['get', 'post'],'/addOns', [MainWebsiteController::class, 'addOns'])->name('addOns');
Route::match(['get','post'], '/payment', [MainWebsiteController::class, 'payment'])->name('payment');
Route::post('/confirm', [MainWebsiteController::class, 'confirm'])->name('confirm');


Route::get('/bookingConfirmation/{reservation_id}', [MailController::class, 'bookingConfirmation'])->name('bookingConfirmation');

/*
Route::get('send-mail', function () {
    $details = [
        'title' => 'Success',
        'content' => 'This is an email testing using Laravel-Brevo',
    ];
   
    Mail::to('enigmainvestment@outlook.com')->send(new \App\Mail\BookingConfirmation($details));
   
    return 'Email sent at ' . now();
});*/


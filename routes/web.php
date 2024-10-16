<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

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
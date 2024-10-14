<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//add admin middleware later
Route::get('/dashboard', [AdminController::class, 'show']);
Route::get('/vehicles', [AdminController::class, 'showVehicles'])->name('vehicles');
Route::get('/AddVehicle', [AdminController::class, 'addvehicle'])->name('AddVehicle');
Route::post('/storeVehicle', [AdminController::class, 'storeVehicle'])->name('storeVehicle');
Route::get('/editVehicle/{vehicle_id}',[AdminController::class, 'editVehicle'])->name('editVehicle');
Route::post('/storeEditVehicle/{vehicle_id}', [AdminController::class, 'storeEditVehicle'])->name('storeEditVehicle');
Route::get('/deleteVehicle/{vehicle_id}', [AdminController::class, 'deleteVehicle'])->name('deleteVehicle');
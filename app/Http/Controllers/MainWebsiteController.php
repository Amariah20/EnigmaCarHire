<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class MainWebsiteController extends Controller
{
    public function homepage(){

        $vehicles = Vehicle::all();

        return view ('homepage', compact('vehicles'));
    }
}

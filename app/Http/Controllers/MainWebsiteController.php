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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainWebsiteController extends Controller
{
    public function homepage(){

        return view ('homepage');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{

    public function addCustomer(){

        return view ('auth.customer');
    }

    public function storeCustomer(Request $req){
        
        $req->validate([
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'regex:/[a-z]/', // at least one lowercase letter
                'regex:/[A-Z]/', // at least one uppercase letter
                'regex:/[0-9]/', // at least one number
            ]
        ], [
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter and a number',
        
            
        ]);

        $customer = new Customer();
        $customer -> name = $req->name;
        $customer->email = $req->email;
        $customer->phone_number = $req->phone_number;
        $customer->license_number = $req->license_number;
        $customer->issuing_country = $req->issuing_country;
        $customer->password = Hash::make($req->password);

        $customer->save();

        return redirect()->back()->with('success', 'Account Created Successfully');


    }



    
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
Use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
 //   protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm(Request $request)
    {
        // Store the intended URL in the session
        session(['url.intended' => url()->previous()]);

        return view('auth.register'); // Your registration view
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => ['required', 'string', 'max:15'], 
            'license_number' => ['required', 'string', 'max:50'], 
            'issuing_country' => ['required', 'string'], 
            'password' => ['required', 'string', 'min:8', 'confirmed'], //CHANGE TO HAVE STRONGER PASSWORD
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Customer
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number'=>$data['phone_number'],
            'license_number'=>$data['license_number'],
            'issuing_country'=>$data['issuing_country'],
            'password' => Hash::make($data['password']),
        ]);
    }


     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // Validate the incoming request
        $this->validator($request->all())->validate();

        // Create the new user
        $user = $this->create($request->all());

        


        // Log the new user in
        Auth::guard('customers')->login($user);

        // Redirect to the intended page or a fallback page
       // return redirect()->intended($this->redirectTo); // Redirect to intended or fallback to '/'
       return redirect()->intended(session('url.intended', '/homepage'));
    }
}

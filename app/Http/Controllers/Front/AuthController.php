<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Http\Requests\Auth\ClientRegister;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function clientRegister(ClientRegister $request)
    {
        // Create a new client
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
            'phone' => $request->phone,
            'd_o_b' => $request->d_o_b,
            'blood_type_id' => $request->blood_type_id,
            'city_id' => $request->city_id,
        ]);
        // Assuming relationships are set correctly
        $client->governorates()->attach($client->city->governorate_id);
        $client->bloodtypes()->attach($request->blood_type_id);


        // Create token for the client
        $token = $client->createToken('auth_token')->plainTextToken;
        Auth::guard('client')->login($client);
//        $client = Auth::guard('client')->user();
//        dd( Auth::guard('client')->user());
        if (Auth::guard('client')->check()) {
            // Redirect to the homepage with success message
            return redirect()->route('HomePage')->with([
                'client_name' => $client->name,
            ]);
        }

        // If login failed, redirect back with error
        return redirect()->back()->withErrors(['message' => 'Registration failed, please try again.']);
    }
    public function clientLogin(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email|exists:clients,email', // Check for existence in the 'clients' table with the correct column
            'password' => 'required|string', // Add string validation to the password
        ]);

        // Find the client by email
        $client = Client::where('email', $request->email)->first();

        // Check if the client exists and if the password is correct
        if (!$client || !Hash::check($request->password, $client->password)) {
            return back()->withErrors([
                'email' => 'These credentials do not match our records.', // Generic error for email
            ])->withInput(); // Retain input values for user convenience
        }

        // Generate a new token for the client
        $token = $client->createToken('Client Token')->plainTextToken;
        Auth::guard('client')->login($client);
        session(['client_token' => $token]);
        flash()->success('login successful');
        return redirect()->route('HomePage'); // You can also flash a success message
    }

    public function clientLogout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect()->route('HomePage');

//        return response()->json(['message' => 'Successfully logged out']);
   }


}

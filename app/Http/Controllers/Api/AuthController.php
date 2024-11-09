<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterAuthRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\Sendcode;

class AuthController
{
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        //Create a new client
        $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashing the password
            'phone' => $request->phone,
            'd_o_b' => $request->d_o_b,
            'blood_type_id' => $request->blood_type_id,
            'city_id' => $request->city_id,
        ]);
        $client->governorates()->attach($client->city->governorate_id);
        $client->bloodtypes()->attach($request->blood_type_id);
        $token = $client->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Client created successfully!',
            'client' => $client,
            'token' => $token
        ], 201);
    }
    public function login(Request $request): array
    {
        $request->validate([
            'email' => 'required|email|exists:clients',
            'password' => 'required'
        ]);

        $user = Client::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'password' => ['The Password are incorrect.']
                ]
            ];
        }
        $token = $user->createToken($user->name);
        return [
            'message' => 'Login successfully!',
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request): array
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'You are logged out.'
        ];
    }
    public function get_profile(Request $request):JsonResponse
    {
        $user = Auth::user();
        return response()->json([
            'profile' => $user
        ], 200);
    }
    public function update(UpdateClientRequest $request, $id):JsonResponse
    {
        $validatedData = $request->validated();
        $client = Client::findOrFail($id);
        if ($request->filled('password')) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }
        $client->update($validatedData);
        return response()->json(['message' => 'Client updated successfully!', 'client' => $client]);
    }
//    public function sendPinCode(Request $request): \Illuminate\Http\JsonResponse
//    {
////        $request->validate([
////            'email' => 'required|email|exists:clients,email',
////        ]);
////        $client = Client::where('email', $request->email)->first();
////        $pin_code = rand(100000, 999999);
////        $client->pin_code = $pin_code;
////        $client->pin_code_expires_at = Carbon::now('Africa/Cairo')->addMinutes(15);
////        $client->save();
////        return response()->json(['message' => 'Pin code sent to your email.'], 200);
//    }
    public function sendPinCode(Request $request):JsonResponse
    {
        // Validate the incoming request to ensure the email is present and exists in the clients table
        $validatedData = $request->validate([
            'email' => 'required|email|exists:clients,email'
        ]);

        // Generate a random pin code
        $pinCode = rand(100000, 999999);

        // Retrieve the client
        $client = Client::where('email', $request->email)->first();

        // Store the pin code in the client's record
        $client->pin_code = $pinCode;
        $client->save();

        // Send the email with the pin code
        try {
            Mail::to($client->email)->send(new Sendcode($pinCode));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to send pin code. Please try again later.'], 500);
        }

        return response()->json([
            'message' => 'Pin code sent successfully!',
            // 'pin_code' => $pinCode // Commented out for production; use logs for debugging if necessary
        ], 200);
    }
    public function resetPassword(Request $request):JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
            'pin_code' => 'required|numeric',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        $client = Client::where('email', $request->email)->first();
        // Validate pin code
        if ($client->pin_code !== $request->pin_code) {
            return response()->json(['message' => 'Invalid pin code.'], 400);
        }
        // Update the password and clear the pin code
        $client->password = Hash::make($request->new_password);
        $client->pin_code = null;
        $client->save();

        return response()->json(['message' => 'Password successfully reset.'], 200);
    }
    public function notificationsSettings(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'governorates.*' => 'exists:governorates,id',
            'blood_types.*' => 'exists:blood_types,id',
        ]);

        // If 'governorates' are provided in the request, sync them with the user's governorates
        if ($request->has('governorates')) {
            $request->user()->governorates()->sync($validatedData['governorates']);
        }

        // If 'blood_types' are provided in the request, sync them with the user's blood types
        if ($request->has('blood_types')) {
            $request->user()->bloodTypes()->sync($validatedData['blood_types']);
        }

        // Retrieve the updated settings for governorates and blood types
        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorates.id')->toArray(),
            'blood_types' => $request->user()->bloodTypes()->pluck('blood_types.id')->toArray(),
        ];

        // Return a JSON response with the updated settings
        return response()->json([
            'message' => 'Updated successfully!',
            'data' => $data,
        ], 200);
    }



}

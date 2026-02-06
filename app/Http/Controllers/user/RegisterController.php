<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\SubCircle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register()
    {
        // Check if user is already logged in
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Get all circles with their subcircles
        $circles = Circle::where('status', true)
            ->with(['subCircles' => function($query) {
                $query->where('status', true);
            }])
            ->get();
            
        return view('register', compact('circles'));
    }

    public function store(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'required|string',
            'state' => 'required|string',
            'district' => 'required|string',
            'pincode' => 'required|string|max:6',
            'occupation' => 'required|string',
            'circle_id' => 'required|exists:circles,id',
            'sub_circle_id' => 'required|exists:sub_circles,id',
            'interests' => 'required|array|min:1',
        ], [
            'interests.required' => 'Please select at least one interest.',
            'interests.min' => 'Please select at least one interest.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create user
        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'country' => $request->country,
            'state' => $request->state,
            'district' => $request->district,
            'pincode' => $request->pincode,
            'occupation' => $request->occupation,
            'circle_id' => $request->circle_id,
            'sub_circle_id' => $request->sub_circle_id,
            'interests' => json_encode($request->interests),
            'verified' => false, // Default to not verified
        ]);

        // Log the user in automatically
        Auth::login($user);

        // Flash success message
        session()->flash('success', 'Registration successful! Welcome to GBS.');

        // Redirect to home page
        return redirect()->route('home');
    }

    public function getSubCircles($circleId)
    {
        $subCircles = SubCircle::where('circle_id', $circleId)
            ->where('status', true)
            ->get();
        return response()->json($subCircles);
    }
}
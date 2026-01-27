<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\SubCircle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register()
    {
        // Get all circles with their subcircles
        $circles = Circle::with('subCircles')->get();
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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
        ]);

        
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function getSubCircles($circleId)
    {
        $subCircles = SubCircle::where('circle_id', $circleId)->get();
        return response()->json($subCircles);
    }
}
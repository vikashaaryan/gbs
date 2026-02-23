<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
     public function edit()
    {
        $user = Auth::user();
        $circles = Circle::where('status', true)->get();
        return view('/user/profile-edit', compact('user', 'circles'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'full_name' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'interests' => 'nullable|string',
            'country' => 'nullable|string',
            'state' => 'nullable|string',
            'district' => 'nullable|string',
            'pincode' => 'nullable|string',
            'circle_id' => 'nullable|exists:circles,id',
            'sub_circle_id' => 'nullable|exists:sub_circles,id',
        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('profile_photo')) {
            // Delete old photo
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return response()->json(['success' => true]);
    }
}

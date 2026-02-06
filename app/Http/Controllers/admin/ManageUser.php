<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Circle;

class ManageUser extends Controller
{
    public function manageUser(Request $request)
    {
        // Start query
        $query = User::with(['circle', 'subCircle']);
        
        // Apply filters
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        if ($request->has('verified') && $request->verified != '') {
            $query->where('verified', $request->verified);
        }
        
        if ($request->has('circle_id') && $request->circle_id != '') {
            $query->where('circle_id', $request->circle_id);
        }
        
        // Get counts for stats
        $totalUsers = User::count();
        $verifiedUsers = User::where('verified', true)->count();
        
        // Get paginated results
        $users = $query->latest()->paginate(10);
        $circles = Circle::where('status', true)->get();
        
        return view('admin.manage-user', compact('users', 'circles', 'totalUsers', 'verifiedUsers'));
    }
    
    public function toggleVerification(Request $request, $id)
    {
        try {
            $request->validate([
                'verified' => 'required|boolean'
            ]);
            
            $user = User::findOrFail($id);
            $user->verified = $request->verified;
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'User verification status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
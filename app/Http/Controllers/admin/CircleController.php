<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    public function index()
    {
      $circles = Circle::orderBy('created_at', 'desc')->get();
        
        return view('admin.manage-circle', compact('circles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        Circle::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Circle created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        $circle = Circle::findOrFail($id);
        $circle->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Circle updated successfully!');
    }

    public function destroy($id)
    {
        $circle = Circle::findOrFail($id);
        
        // Check if circle has children before deleting
        if ($circle->children()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete circle with sub-circles. Delete sub-circles first.');
        }
        
        $circle->delete();

        return redirect()->back()->with('success', 'Circle deleted successfully!');
    }

   
}
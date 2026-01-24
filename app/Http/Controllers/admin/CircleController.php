<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;

class CircleController extends Controller
{
    public function index()
    {
        $circles = Circle::with('parent')
            ->orderBy('created_at', 'desc')
            ->get();
            
        $parentCircles = Circle::whereNull('parent_id')->get();
        
        return view('admin.manage-circle', compact('circles', 'parentCircles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:circles,id',
            'description' => 'nullable|string'
        ]);

        Circle::create($request->all());

        return redirect()->back()->with('success', 'Circle created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:circles,id',
            'description' => 'nullable|string'
        ]);

        $circle = Circle::findOrFail($id);
        $circle->update($request->all());

        return redirect()->back()->with('success', 'Circle updated successfully!');
    }

    public function destroy($id)
    {
        $circle = Circle::findOrFail($id);
        $circle->delete();

        return redirect()->back()->with('success', 'Circle deleted successfully!');
    }
}
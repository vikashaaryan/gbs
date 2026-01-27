<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\SubCircle;
use Illuminate\Http\Request;

class SubCircleController extends Controller
{
     public function index()
    {
        return view('admin.manage-subcircle', [
            'circles' => Circle::all(),
            'subCircles' => SubCircle::with('circle')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'circle_id' => 'required|exists:circles,id',
            'subcircle' => 'required|string|max:255'
        ]);

        SubCircle::create($request->all());

        return back()->with('success', 'Sub Circle added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'circle_id' => 'required|exists:circles,id',
            'subcircle' => 'required|string|max:255'
        ]);

        SubCircle::findOrFail($id)->update($request->all());

        return back()->with('success', 'Sub Circle updated successfully');
    }

    public function destroy($id)
    {
        SubCircle::findOrFail($id)->delete();
        return back()->with('success', 'Sub Circle deleted');
    }
}

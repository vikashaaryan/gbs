<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.manage-catagory', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Category::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.manage-categories')
            ->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:categories,title,' . $id,
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.manage-categories')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);  
        $category->delete();
        return redirect()->route('admin.manage-categories')
            ->with('success', 'Category deleted successfully!');
    }
}
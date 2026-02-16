<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Circle;
use App\Models\SubCircle;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResourceController extends Controller
{
    /**
     * Display a listing of resources with filters and pagination.
     */
    public function manageResources(Request $request)
    {
        $query = Resource::with(['circle', 'subCircle', 'user', 'category'])
            ->orderBy('created_at', 'desc');

        // Apply filters
        if ($request->filled('circle_id')) {
            $query->where('circle_id', $request->circle_id);
        }

        if ($request->filled('sub_circle_id')) {
            $query->where('sub_circle_id', $request->sub_circle_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Get statistics
        $totalResources = Resource::count();
        $newResourcesToday = Resource::whereDate('created_at', today())->count();

        // Pagination
        $perPage = $request->get('per_page', 10);
        $resources = $query->paginate($perPage)->withQueryString();

        // Get data for filters
        $circles = Circle::where('status', true)->orderBy('title')->get();
        $subCircles = SubCircle::where('status', true)->orderBy('subcircle')->get();
        $categories = Category::where('status', true)->orderBy('title')->get();
        $users = User::orderBy('full_name')->get(['id', 'full_name', 'email']);

        return view('admin.resources-index', compact(
            'resources',
            'circles',
            'subCircles',
            'categories',
            'users',
            'totalResources',
            'newResourcesToday'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createResource()
    {
        $circles = Circle::where('status', true)->orderBy('title')->get();
        $subCircles = SubCircle::where('status', true)->orderBy('subcircle')->get();
        $categories = Category::where('status', true)->orderBy('title')->get();
        
        return view('admin.resource-create', compact('circles', 'subCircles', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'circle_id' => 'required|exists:circles,id',
            'sub_circle_id' => 'nullable|exists:sub_circles,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:audio,video,pdf,image,document,other',
            'file' => 'nullable|file|max:102400', // 100MB max
            'thumbnail' => 'nullable|image|max:5120', // 5MB max
            'external_url' => 'nullable|url|max:255',
            'file_size' => 'nullable|string|max:50',
            'published_date' => 'nullable|date',
            'language' => 'nullable|string|max:50'
        ]);

        try {
            $resource = new Resource();
            $resource->title = $request->title;
            $resource->description = $request->description;
            $resource->circle_id = $request->circle_id;
            $resource->sub_circle_id = $request->sub_circle_id;
            $resource->category_id = $request->category_id;
            $resource->user_id = Auth::id();
            $resource->type = $request->type;
            $resource->language = $request->language ?? 'English';
            $resource->published_date = $request->published_date;
            
            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('resources/' . $request->type, $fileName, 'public');
                $resource->file_path = $filePath;
                
                // Set file size if not provided
                if (!$request->filled('file_size')) {
                    $size = $file->getSize();
                    $resource->file_size = $this->formatBytes($size);
                }
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_thumb_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('resources/thumbnails', $thumbnailName, 'public');
                $resource->thumbnail_path = $thumbnailPath;
            }

            // External URL
            if ($request->filled('external_url')) {
                $resource->external_url = $request->external_url;
            }

            // File size
            if ($request->filled('file_size')) {
                $resource->file_size = $request->file_size;
            }

            $resource->save();

            return redirect()->route('admin.manage-resources')
                ->with('success', 'Resource created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resource = Resource::with(['circle', 'subCircle', 'user', 'category'])
            ->findOrFail($id);
        
        return view('admin.resource-show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $resource = Resource::findOrFail($id);
        $circles = Circle::where('status', true)->orderBy('title')->get();
        $subCircles = SubCircle::where('status', true)->orderBy('subcircle')->get();
        $categories = Category::where('status', true)->orderBy('title')->get();
        
        return view('admin.resource-edit', compact('resource', 'circles', 'subCircles', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'circle_id' => 'required|exists:circles,id',
            'sub_circle_id' => 'nullable|exists:sub_circles,id',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:audio,video,pdf,image,document,other',
            'file' => 'nullable|file|max:102400',
            'thumbnail' => 'nullable|image|max:5120',
            'external_url' => 'nullable|url|max:255',
            'file_size' => 'nullable|string|max:50',
            'published_date' => 'nullable|date',
            'language' => 'nullable|string|max:50'
        ]);

        try {
            $resource->title = $request->title;
            $resource->description = $request->description;
            $resource->circle_id = $request->circle_id;
            $resource->sub_circle_id = $request->sub_circle_id;
            $resource->category_id = $request->category_id;
            $resource->type = $request->type;
            $resource->language = $request->language ?? 'English';
            $resource->published_date = $request->published_date;

            // Handle file upload
            if ($request->hasFile('file')) {
                // Delete old file
                if ($resource->file_path) {
                    Storage::disk('public')->delete($resource->file_path);
                }

                $file = $request->file('file');
                $fileName = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('resources/' . $request->type, $fileName, 'public');
                $resource->file_path = $filePath;
                
                // Update file size
                $size = $file->getSize();
                $resource->file_size = $this->formatBytes($size);
            }

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail
                if ($resource->thumbnail_path) {
                    Storage::disk('public')->delete($resource->thumbnail_path);
                }

                $thumbnail = $request->file('thumbnail');
                $thumbnailName = time() . '_thumb_' . Str::slug($request->title) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('resources/thumbnails', $thumbnailName, 'public');
                $resource->thumbnail_path = $thumbnailPath;
            }

            // External URL
            $resource->external_url = $request->external_url;

            // File size (if manually provided)
            if ($request->filled('file_size') && !$request->hasFile('file')) {
                $resource->file_size = $request->file_size;
            }

            $resource->save();

            return redirect()->route('admin.manage-resources')
                ->with('success', 'Resource updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating resource: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $resource = Resource::findOrFail($id);
            
            // Delete associated files
            if ($resource->file_path) {
                Storage::disk('public')->delete($resource->file_path);
            }
            
            if ($resource->thumbnail_path) {
                Storage::disk('public')->delete($resource->thumbnail_path);
            }
            
            $resource->delete();

            return redirect()->route('admin.manage-resources')
                ->with('success', 'Resource deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error deleting resource: ' . $e->getMessage());
        }
    }

    /**
     * Preview resource.
     */
    public function preview($id)
    {
        $resource = Resource::with(['circle', 'subCircle', 'user', 'category'])
            ->findOrFail($id);
        
        return view('admin.resource-preview', compact('resource'));
    }

    /**
     * Format bytes to human readable format.
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
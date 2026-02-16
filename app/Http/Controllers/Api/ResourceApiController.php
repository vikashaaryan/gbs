<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\SubCircle;
use App\Models\Category;
use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceApiController extends Controller
{
    /**
     * Get sub-circles for a specific circle
     */
    public function getSubCircles($circleId)
    {
        try {
            $subCircles = SubCircle::where('circle_id', $circleId)
                ->where('status', true)
                ->orderBy('subcircle')
                ->get(['id', 'subcircle', 'circle_id']); // description hata diya
            
            return response()->json($subCircles);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get categories for a specific sub-circle
     */
    public function getCategoriesBySubCircle($subCircleId)
    {
        try {
            $categories = Category::whereHas('resources', function($query) use ($subCircleId) {
                $query->where('sub_circle_id', $subCircleId);
            })
            ->where('status', true)
            ->orderBy('title')
            ->get(['id', 'title']); // description hata diya
            
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get categories for a specific circle (direct, no sub-circle)
     */
    public function getCategoriesByCircle($circleId)
    {
        try {
            $categories = Category::whereHas('resources', function($query) use ($circleId) {
                $query->where('circle_id', $circleId);
            })
            ->where('status', true)
            ->orderBy('title')
            ->get(['id', 'title']); // description hata diya
            
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get resources with various filters
     */
    public function getResources(Request $request)
    {
        try {
            $query = Resource::with(['circle', 'subCircle', 'category']);

            if ($request->has('circle_id') && $request->circle_id) {
                $query->where('circle_id', $request->circle_id);
            }

            if ($request->has('sub_circle_id') && $request->sub_circle_id) {
                $query->where('sub_circle_id', $request->sub_circle_id);
            }

            if ($request->has('category_id') && $request->category_id) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->has('type') && $request->type) {
                $query->where('type', $request->type);
            }

            $resources = $query->latest()->get();

            $resources->each(function($resource) {
                if ($resource->thumbnail_path) {
                    $resource->thumbnail_url = asset('storage/' . $resource->thumbnail_path);
                }
                if ($resource->file_path) {
                    $resource->file_url = asset('storage/' . $resource->file_path);
                }
            });

            return response()->json($resources);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
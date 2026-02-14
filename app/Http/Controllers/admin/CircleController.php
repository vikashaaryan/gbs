<?php
// app/Http/Controllers/Admin/CircleController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CircleController extends Controller
{
    public function index()
    {
        $circles = Circle::orderBy('created_at', 'desc')->get();
        return view('admin.manage-circle', compact('circles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'location_data' => 'nullable|json', // पूरा location data JSON में आएगा
            'status' => 'boolean'
        ]);

        // Location data को JSON में store करें
        if ($request->has('location_data') && !empty($request->location_data)) {
            $validated['location'] = json_decode($request->location_data, true);
        }

        $validated['status'] = $request->has('status') ? true : false;

        Circle::create($validated);

        return redirect()->route('admin.circles.index')
            ->with('success', 'Circle created successfully!');
    }

    public function update(Request $request, Circle $circle)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'location_data' => 'nullable|json',
            'status' => 'boolean'
        ]);

        if ($request->has('location_data') && !empty($request->location_data)) {
            $validated['location'] = json_decode($request->location_data, true);
        }

        $validated['status'] = $request->has('status') ? true : false;

        $circle->update($validated);

        return redirect()->route('admin.circles.index')
            ->with('success', 'Circle updated successfully!');
    }

    public function destroy(Circle $circle)
    {
        $circle->delete();
        return redirect()->route('admin.circles.index')
            ->with('success', 'Circle deleted successfully!');
    }

    /**
     * API endpoint for location search
     */
    public function searchLocations(Request $request)
    {
        $query = $request->get('q');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        try {
            // OpenStreetMap Nominatim API (free)
            $response = Http::withHeaders([
                'User-Agent' => 'YourApp/1.0',
            ])->get('https://nominatim.openstreetmap.org/search', [
                'q' => $query,
                'format' => 'json',
                'limit' => 5,
                'addressdetails' => 1
            ]);

            if ($response->successful()) {
                $results = collect($response->json())->map(function ($item) {
                    // Extract address components
                    $address = $item['address'] ?? [];
                    
                    return [
                        'id' => $item['place_id'],
                        'name' => $item['display_name'],
                        'city' => $address['city'] ?? $address['town'] ?? $address['village'] ?? $address['county'] ?? null,
                        'state' => $address['state'] ?? null,
                        'country' => $address['country'] ?? null,
                        'pincode' => $address['postcode'] ?? null,
                        'latitude' => $item['lat'],
                        'longitude' => $item['lon'],
                        'display' => $this->formatDisplayName($item)
                    ];
                });
                
                return response()->json($results);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch locations'], 500);
        }

        return response()->json([]);
    }

    private function formatDisplayName($item)
    {
        $address = $item['address'] ?? [];
        $parts = [];
        
        if (isset($address['city']) || isset($address['town']) || isset($address['village'])) {
            $parts[] = $address['city'] ?? $address['town'] ?? $address['village'];
        }
        if (isset($address['state'])) {
            $parts[] = $address['state'];
        }
        if (isset($address['country'])) {
            $parts[] = $address['country'];
        }
        
        return implode(', ', $parts);
    }
}
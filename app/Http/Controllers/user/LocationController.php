<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');
            
            if (strlen($query) < 2) {
                return response()->json([]);
            }

            // Get all circles with locations
            $circles = Circle::where('status', true)
                ->whereNotNull('location')
                ->get();

            $locations = [];
            
            foreach ($circles as $circle) {
                // Decode location JSON
                $location = is_string($circle->location) ? 
                    json_decode($circle->location, true) : 
                    $circle->location;
                
                if (!$location || !isset($location['city'])) {
                    continue;
                }
                
                // Create a unique key for this location
                $key = ($location['city'] ?? '') . '|' . 
                       ($location['state'] ?? '') . '|' . 
                       ($location['country'] ?? '');
                
                // Check if location matches search query
                $searchText = ($location['city'] ?? '') . ' ' . 
                             ($location['state'] ?? '') . ' ' . 
                             ($location['country'] ?? '');
                
                if (stripos($searchText, $query) !== false) {
                    // Store in associative array to avoid duplicates
                    $locations[$key] = [
                        'name' => $location['name'] ?? ($location['city'] ?? ''),
                        'city' => $location['city'] ?? '',
                        'state' => $location['state'] ?? '',
                        'country' => $location['country'] ?? 'India',
                        'pincode' => $location['pincode'] ?? '',
                        'latitude' => $location['latitude'] ?? null,
                        'longitude' => $location['longitude'] ?? null,
                        'display' => trim(
                            ($location['city'] ?? '') . ' ' . 
                            ($location['state'] ?? '') . ' ' . 
                            ($location['country'] ?? 'India')
                        ),
                    ];
                }
            }
            
            // Convert back to indexed array and limit to 10 results
            $results = array_values(array_slice($locations, 0, 10));
            
            // Log for debugging
            Log::info('Location search:', [
                'query' => $query,
                'results_count' => count($results),
                'results' => $results
            ]);
            
            return response()->json($results);
            
        } catch (\Exception $e) {
            Log::error('Location search error: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed'], 500);
        }
    }

    /**
     * Set user's selected location in session
     */
    public function setLocation(Request $request)
    {
        try {
            $location = json_decode($request->location, true);
            
            if ($location) {
                session([
                    'selected_location' => $location,
                    'selected_location_name' => $location['city'] ?? $location['name'] ?? 'Selected Location'
                ]);
                
                return response()->json(['success' => true]);
            }
            
            return response()->json(['success' => false, 'message' => 'Invalid location data'], 400);
            
        } catch (\Exception $e) {
            Log::error('Set location error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error'], 500);
        }
    }

    /**
     * Clear location filter from session
     */
    public function clearLocation(Request $request)
    {
        session()->forget(['selected_location', 'selected_location_name']);
        return response()->json(['success' => true]);
    }
}

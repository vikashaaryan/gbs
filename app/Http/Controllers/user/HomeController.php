<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Circle;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $query = Circle::where('status', true);
        $isFiltered = false;
        $locationTerm = null;
        
        // Check if location search is applied
        if ($request->has('location') && !empty($request->location)) {
            $isFiltered = true;
            $locationData = null;
            
            // Try to decode if it's JSON
            if (is_string($request->location)) {
                // Check if it's a JSON string
                if ($request->location[0] === '{' || $request->location[0] === '[') {
                    $locationData = json_decode($request->location, true);
                } else {
                    // It's a plain text search
                    $locationData = ['search_term' => $request->location];
                }
            }
            
            if ($locationData && is_array($locationData)) {
                // Extract search terms
                $city = $locationData['city'] ?? null;
                $state = $locationData['state'] ?? null;
                $country = $locationData['country'] ?? null;
                $name = $locationData['name'] ?? null;
                $searchTerm = $locationData['search_term'] ?? $name ?? $city ?? $state ?? $country ?? $request->location;
                
                // Clean the search term
                $searchTerm = trim($searchTerm);
                
                // For debugging
                Log::info('Searching for:', [
                    'term' => $searchTerm,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]);
                
                // Build search query - ONLY match if the term exists in location fields
                $query->where(function($q) use ($city, $state, $country, $searchTerm) {
                    $term = strtolower($searchTerm);
                    
                    // If we have specific fields from JSON, search in those fields only
                    if ($city && $city !== 'null' && !empty($city)) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ?', ['%' . strtolower($city) . '%']);
                    } 
                    elseif ($state && $state !== 'null' && !empty($state)) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ?', ['%' . strtolower($state) . '%']);
                    }
                    elseif ($country && $country !== 'null' && !empty($country)) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ?', ['%' . strtolower($country) . '%']);
                    }
                    else {
                        // For text search, make sure we only match non-empty fields
                        $q->where(function($sub) use ($term) {
                            $sub->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ? AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.city")) IS NOT NULL AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.city")) != ""', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ? AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.state")) IS NOT NULL AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.state")) != ""', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ? AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.country")) IS NOT NULL AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.country")) != ""', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.display"))) LIKE ? AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.display")) IS NOT NULL AND JSON_UNQUOTE(JSON_EXTRACT(location, "$.display")) != ""', ['%' . $term . '%']);
                        });
                    }
                });
            }
            
            $circles = $query->get();
            
            // Get the search term for display
            if ($locationData && is_array($locationData)) {
                $locationTerm = $locationData['city'] ?? $locationData['state'] ?? $locationData['country'] ?? $locationData['name'] ?? $request->location;
            } else {
                $locationTerm = $request->location;
            }
            
            // Clean up the location term
            if (is_string($locationTerm)) {
                $locationTerm = trim($locationTerm, '"{}[]');
                $locationTerm = str_replace(['null', ':"', '"}'], '', $locationTerm);
            }
        } else {
            // No location filter - show all circles
            $circles = $query->get();
        }
        
        return view('homepage', compact('circles', 'isFiltered', 'locationTerm'));
    }
    
    // API endpoint for location search
    public function searchLocations(Request $request)
    {
        $term = $request->q;
        
        if (empty($term) || strlen($term) < 2) {
            return response()->json([]);
        }
        
        // Get all circles with location data
        $circles = Circle::where('status', true)
            ->whereNotNull('location')
            ->get();
        
        $locations = [];
        $seen = [];
        
        foreach ($circles as $circle) {
            $location = $circle->location;
            if ($location && is_array($location)) {
                // Extract location components (only non-empty values)
                $city = !empty($location['city']) ? $location['city'] : '';
                $state = !empty($location['state']) ? $location['state'] : '';
                $country = !empty($location['country']) ? $location['country'] : '';
                
                // Create display name from non-empty parts
                $parts = array_filter([$city, $state, $country]);
                $display = implode(', ', $parts);
                
                // Check if this location matches the search term (case-insensitive)
                $matchFound = false;
                if (!empty($city) && stripos($city, $term) !== false) $matchFound = true;
                if (!empty($state) && stripos($state, $term) !== false) $matchFound = true;
                if (!empty($country) && stripos($country, $term) !== false) $matchFound = true;
                
                if ($matchFound) {
                    // Create a unique key for each location
                    $key = $city . '|' . $state . '|' . $country;
                    
                    if (!isset($seen[$key])) {
                        $seen[$key] = true;
                        
                        $locations[] = [
                            'name' => $city ?: ($state ?: $country),
                            'city' => $city,
                            'state' => $state,
                            'country' => $country,
                            'display' => $display,
                            'exists' => true
                        ];
                    }
                }
            }
        }
        
        // If no locations found in database, return suggestions
        if (empty($locations)) {
            return response()->json([
                [
                    'name' => $term,
                    'city' => $term,
                    'state' => '',
                    'country' => '',
                    'display' => "Search for circles in \"{$term}\"",
                    'exists' => false,
                    'suggestion' => true
                ]
            ]);
        }
        
        return response()->json(array_values($locations));
    }
}
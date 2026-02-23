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
        $searchedLocation = null;
        $locationExists = false;
        
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
                // Extract search terms (only non-empty values)
                $city = isset($locationData['city']) && $locationData['city'] !== 'null' && trim($locationData['city']) !== '' ? trim($locationData['city']) : null;
                $state = isset($locationData['state']) && $locationData['state'] !== 'null' && trim($locationData['state']) !== '' ? trim($locationData['state']) : null;
                $country = isset($locationData['country']) && $locationData['country'] !== 'null' && trim($locationData['country']) !== '' ? trim($locationData['country']) : null;
                $name = isset($locationData['name']) && $locationData['name'] !== 'null' && trim($locationData['name']) !== '' ? trim($locationData['name']) : null;
                $searchTerm = isset($locationData['search_term']) && $locationData['search_term'] !== 'null' && trim($locationData['search_term']) !== '' ? trim($locationData['search_term']) : null;
                
                // For debugging
                Log::info('Searching for:', [
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'name' => $name,
                    'search_term' => $searchTerm
                ]);
                
                // Build search query - match if the term exists in location fields
                $query->where(function($q) use ($city, $state, $country, $name, $searchTerm) {
                    // If we have specific fields from JSON, search in those fields
                    if ($city) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ?', ['%' . strtolower($city) . '%']);
                    } 
                    elseif ($state) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ?', ['%' . strtolower($state) . '%']);
                    }
                    elseif ($country) {
                        $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ?', ['%' . strtolower($country) . '%']);
                    }
                    elseif ($name) {
                        $q->where(function($sub) use ($name) {
                            $term = strtolower($name);
                            $sub->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ?', ['%' . $term . '%']);
                        });
                    }
                    elseif ($searchTerm) {
                        $q->where(function($sub) use ($searchTerm) {
                            $term = strtolower($searchTerm);
                            $sub->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ?', ['%' . $term . '%'])
                                ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ?', ['%' . $term . '%']);
                        });
                    }
                });
                
                // Set location term for display
                if ($city) {
                    $locationTerm = $city;
                    $searchedLocation = $city;
                } elseif ($state) {
                    $locationTerm = $state;
                    $searchedLocation = $state;
                } elseif ($country) {
                    $locationTerm = $country;
                    $searchedLocation = $country;
                } elseif ($name) {
                    $locationTerm = $name;
                    $searchedLocation = $name;
                } elseif ($searchTerm) {
                    $locationTerm = $searchTerm;
                    $searchedLocation = $searchTerm;
                } else {
                    $locationTerm = $request->location;
                    $searchedLocation = $request->location;
                }
            }
            
            $circles = $query->get();
            
            // Check if any circles exist in this location
            $locationExists = $circles->count() > 0;
            
            // Clean up the location term
            if (is_string($locationTerm)) {
                $locationTerm = trim($locationTerm, '"{}[]');
                $locationTerm = str_replace(['null', ':"', '"}', '\\'], '', $locationTerm);
            }
        } else {
            // No location filter - show all circles
            $circles = $query->get();
        }
        
        return view('homepage', compact('circles', 'isFiltered', 'locationTerm', 'searchedLocation', 'locationExists'));
    }
    
    // API endpoint for location search - THIS SHOWS THE DROPDOWN
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
        
        // First, get locations from database
        foreach ($circles as $circle) {
            $location = $circle->location;
            if ($location && is_array($location)) {
                // Extract location components (only non-empty values)
                $city = !empty($location['city']) && $location['city'] !== 'null' ? trim($location['city']) : '';
                $state = !empty($location['state']) && $location['state'] !== 'null' ? trim($location['state']) : '';
                $country = !empty($location['country']) && $location['country'] !== 'null' ? trim($location['country']) : '';
                
                // Create display name from non-empty parts
                $parts = array_filter([$city, $state, $country]);
                $display = implode(', ', $parts);
                
                // Skip if display is empty
                if (empty($display)) {
                    continue;
                }
                
                // Check if this location matches the search term (case-insensitive)
                $matchFound = false;
                $matchScore = 0;
                
                if (!empty($city) && stripos($city, $term) !== false) {
                    $matchFound = true;
                    $matchScore += 10; // City matches are most relevant
                }
                if (!empty($state) && stripos($state, $term) !== false) {
                    $matchFound = true;
                    $matchScore += 5; // State matches are medium relevant
                }
                if (!empty($country) && stripos($country, $term) !== false) {
                    $matchFound = true;
                    $matchScore += 3; // Country matches are least relevant
                }
                
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
                            'exists' => true,
                            'score' => $matchScore
                        ];
                    }
                }
            }
        }
        
        // Sort locations by score (best matches first)
        usort($locations, function($a, $b) {
            return $b['score'] - $a['score'];
        });
        
        // ALWAYS add the search term as an option (so user can search any location)
        // Check if search term already exists in results
        $searchTermExists = false;
        foreach ($locations as $loc) {
            if (strtolower($loc['name']) === strtolower($term) || 
                strtolower($loc['city']) === strtolower($term) ||
                strtolower($loc['state']) === strtolower($term) ||
                strtolower($loc['country']) === strtolower($term)) {
                $searchTermExists = true;
                break;
            }
        }
        
        // Add the search term as an option if it's not already in results
        if (!$searchTermExists) {
            // Put search term at the top of results
            array_unshift($locations, [
                'name' => $term,
                'city' => $term,
                'state' => '',
                'country' => '',
                'display' => $term,
                'exists' => false,
                'suggestion' => true,
                'score' => 100 // Always show search term at top
            ]);
        }
        
        // Limit results to 10
        $locations = array_slice($locations, 0, 10);
        
        return response()->json(array_values($locations));
    }
}
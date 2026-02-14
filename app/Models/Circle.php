<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = [
        'title', 
        'icon', 
        'description',
        'location',  // JSON column for location data
        'status'     // boolean for active/inactive
    ];

    protected $casts = [
        'location' => 'array',  // Automatically convert JSON to array
        'status' => 'boolean',   // Convert to boolean
    ];

    // Relationships
    public function subCircles()
    {
        return $this->hasMany(SubCircle::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Helper method to get city from location
    public function getCityAttribute()
    {
        return $this->location['city'] ?? null;
    }

    // Helper method to get full address
    public function getFullAddressAttribute()
    {
        $location = $this->location;
        if (!$location) return null;
        
        return $location['full_address'] ?? 
               $location['formatted_address'] ?? 
               $location['display'] ?? 
               ($location['city'] ?? '') . ', ' . 
               ($location['state'] ?? '') . ', ' . 
               ($location['country'] ?? '');
    }

    // Helper method to get coordinates
    public function getCoordinatesAttribute()
    {
        $location = $this->location;
        if (!$location) return null;
        
        if (isset($location['latitude']) && isset($location['longitude'])) {
            return [
                'lat' => $location['latitude'],
                'lng' => $location['longitude']
            ];
        }
        
        return null;
    }

    // Scope for active circles
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Scope for inactive circles
    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    // Scope to filter by city
    public function scopeInCity($query, $city)
    {
        return $query->whereRaw('JSON_EXTRACT(location, "$.city") = ?', [$city]);
    }

    // Scope to filter by state
    public function scopeInState($query, $state)
    {
        return $query->whereRaw('JSON_EXTRACT(location, "$.state") = ?', [$state]);
    }

    // Scope to filter by country
    public function scopeInCountry($query, $country)
    {
        return $query->whereRaw('JSON_EXTRACT(location, "$.country") = ?', [$country]);
    }

    // Scope to search location
    public function scopeSearchLocation($query, $term)
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function($q) use ($term) {
            $q->whereRaw('LOWER(JSON_EXTRACT(location, "$.city")) LIKE ?', ['%' . strtolower($term) . '%'])
              ->orWhereRaw('LOWER(JSON_EXTRACT(location, "$.state")) LIKE ?', ['%' . strtolower($term) . '%'])
              ->orWhereRaw('LOWER(JSON_EXTRACT(location, "$.country")) LIKE ?', ['%' . strtolower($term) . '%'])
              ->orWhereRaw('LOWER(JSON_EXTRACT(location, "$.name")) LIKE ?', ['%' . strtolower($term) . '%'])
              ->orWhereRaw('LOWER(JSON_EXTRACT(location, "$.display")) LIKE ?', ['%' . strtolower($term) . '%']);
        });
    }
}
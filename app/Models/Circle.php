<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = [
        'title', 
        'icon', 
        'description',
        'location',
        'status'
    ];

    protected $casts = [
        'location' => 'array',
        'status' => 'boolean',
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

    // Helper method to get state from location
    public function getStateAttribute()
    {
        return $this->location['state'] ?? null;
    }

    // Helper method to get country from location
    public function getCountryAttribute()
    {
        return $this->location['country'] ?? null;
    }

    // Helper method to get full address
    public function getFullAddressAttribute()
    {
        $location = $this->location;
        if (!$location || !is_array($location)) return null;
        
        // Try different possible address fields
        if (isset($location['display']) && !empty($location['display'])) {
            return $location['display'];
        }
        
        if (isset($location['formatted_address']) && !empty($location['formatted_address'])) {
            return $location['formatted_address'];
        }
        
        // Build address from components
        $parts = [];
        if (!empty($location['city'])) $parts[] = $location['city'];
        if (!empty($location['state'])) $parts[] = $location['state'];
        if (!empty($location['country'])) $parts[] = $location['country'];
        
        return !empty($parts) ? implode(', ', $parts) : null;
    }

    // Helper method to get coordinates
    public function getCoordinatesAttribute()
    {
        $location = $this->location;
        if (!$location || !is_array($location)) return null;
        
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

    // Scope to search location (improved version)
    public function scopeSearchLocation($query, $term)
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function($q) use ($term) {
            $term = strtolower($term);
            
            // For MySQL
            $q->whereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.city"))) LIKE ?', ['%' . $term . '%'])
              ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.state"))) LIKE ?', ['%' . $term . '%'])
              ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.country"))) LIKE ?', ['%' . $term . '%'])
              ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.display"))) LIKE ?', ['%' . $term . '%'])
              ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.formatted_address"))) LIKE ?', ['%' . $term . '%'])
              ->orWhereRaw('LOWER(JSON_UNQUOTE(JSON_EXTRACT(location, "$.name"))) LIKE ?', ['%' . $term . '%']);
        });
    }
    
}
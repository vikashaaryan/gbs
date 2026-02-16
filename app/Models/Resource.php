<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_circle_id',
        'circle_id',
        'user_id',
        'category_id',
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail_path',
        'external_url',
        'file_size',
        'published_date',
        'language'
    ];

    protected $casts = [
        'published_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * Get the circle that owns the resource.
     */
    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * Get the sub circle that owns the resource.
     */
    public function subCircle()
    {
        return $this->belongsTo(SubCircle::class, 'sub_circle_id');
    }

    /**
     * Get the user that created the resource.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the resource.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to filter by circle.
     */
    public function scopeInCircle($query, $circleId)
    {
        return $query->where('circle_id', $circleId);
    }

    /**
     * Scope a query to filter by sub circle.
     */
    public function scopeInSubCircle($query, $subCircleId)
    {
        return $query->where('sub_circle_id', $subCircleId);
    }

    /**
     * Scope a query to filter by category.
     */
    public function scopeInCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get the file URL attribute.
     */
    public function getFileUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    /**
     * Get the thumbnail URL attribute.
     */
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? asset('storage/' . $this->thumbnail_path) : null;
    }

    /**
     * Get the type icon attribute.
     */
    public function getTypeIconAttribute()
    {
        return match($this->type) {
            'audio' => '🎵',
            'video' => '🎥',
            'pdf' => '📄',
            'image' => '🖼️',
            'document' => '📝',
            default => '📦'
        };
    }

    /**
     * Get the type color attribute for UI.
     */
    public function getTypeColorAttribute()
    {
        return match($this->type) {
            'video' => 'red',
            'audio' => 'blue',
            'pdf' => 'amber',
            'image' => 'green',
            'document' => 'purple',
            default => 'gray'
        };
    }
}
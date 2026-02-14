<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_circle_id',
        'circle_id',
        'user_id',
        'title',
        'description',
        'type',
        'file_path',
        'thumbnail_path',
        'external_url',
        'duration',
        'episodes',
        'chapters',
        'file_size',
        'pages',
        'total_files',
        'categories_count',
        'author',
        'publisher',
        'published_date',
        'language'
    ];

    protected $casts = [
        'published_date' => 'date'
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function subCircle()
    {
        return $this->belongsTo(SubCircle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper method to get file URL
    public function getFileUrlAttribute()
    {
        return $this->file_path ? Storage::url($this->file_path) : null;
    }

    // Helper method to get thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null;
    }

    // Helper method to determine if resource is video
    public function getIsVideoAttribute()
    {
        return $this->type === 'video';
    }

    // Helper method to determine if resource is audio
    public function getIsAudioAttribute()
    {
        return $this->type === 'audio';
    }

    // Helper method to determine if resource is pdf
    public function getIsPdfAttribute()
    {
        return $this->type === 'pdf';
    }

    // Helper method to determine if resource is image
    public function getIsImageAttribute()
    {
        return $this->type === 'image';
    }

    // Helper method to determine if resource is document
    public function getIsDocumentAttribute()
    {
        return $this->type === 'document';
    }
}
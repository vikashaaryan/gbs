<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'photo',
        'audio',
        'video',
        'document',
        'type',
        'media',
        'likes_count',
        'comments_count',
        'shares_count'
    ];

    protected $casts = [
        'media' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function circle()
    {
        return $this->user->circle();
    }

    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class)->whereNull('parent_id');
    }

    public function hasLiked($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    // Get media type icon
    public function getMediaIcon()
    {
        switch($this->type) {
            case 'photo':
                return 'fas fa-image text-green-600';
            case 'video':
                return 'fas fa-video text-red-600';
            case 'audio':
                return 'fas fa-music text-purple-600';
            case 'document':
                return 'fas fa-file-pdf text-red-600';
            default:
                return 'fas fa-file text-blue-600';
        }
    }

    // Get media type color for badge
    public function getMediaColor()
    {
        switch($this->type) {
            case 'photo':
                return 'bg-green-100 text-green-800';
            case 'video':
                return 'bg-red-100 text-red-800';
            case 'audio':
                return 'bg-purple-100 text-purple-800';
            case 'document':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-blue-100 text-blue-800';
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = ['category', 'parent_id', 'description'];
    
    public function parent()
    {
        return $this->belongsTo(Circle::class, 'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(Circle::class, 'parent_id');
    }
}
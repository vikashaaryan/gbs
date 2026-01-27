<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCircle extends Model
{
      protected $fillable = ['subcircle', 'circle_id'];
    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * Relationship with Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

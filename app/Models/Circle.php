<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{
    protected $fillable = ['title', 'icon', 'description'];

    public function subCircles()
    {
        return $this->hasMany(SubCircle::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password',
        'country',
        'state',
        'district',
        'pincode',
        'occupation',
        'circle_id',
        'sub_circle_id',
        'interests',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'interests' => 'array',
            'terms_accepted' => 'boolean',
        ];
    }

    /**
     * Relationship with Circle
     */
    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    /**
     * Relationship with SubCircle
     */
    public function subCircle()
    {
        return $this->belongsTo(SubCircle::class);
    }
}
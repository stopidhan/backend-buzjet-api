<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'duration','night', 'capacity', 'created_by'];

    public function destinations()
    {
        return $this->belongsToMany(Destination::class, 'package_destinations');
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class, 'package_hotels');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}


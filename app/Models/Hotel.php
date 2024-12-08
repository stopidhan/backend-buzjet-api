<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location_id', 'price_per_night', 'rating'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_hotels');
    }
}

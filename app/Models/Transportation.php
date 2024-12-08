<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transportation extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'price', 'provider', 'location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

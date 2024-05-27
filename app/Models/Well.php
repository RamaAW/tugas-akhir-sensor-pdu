<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'address', 'latitude', 'longitude', 'placeId'];

    public function places()
    {
        return $this->belongsTo(Place::class, 'placeId');
    }
}

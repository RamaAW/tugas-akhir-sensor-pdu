<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Well extends Model
{
    protected $fillable = ['id', 'name', 'address', 'latitude', 'longitude', 'placeId'];
}

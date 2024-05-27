<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['id', 'name', 'address', 'latitude', 'longitude', 'companyId'];
    protected $keyType = 'string';

    public function wells()
    {
        return $this->hasMany(Well::class, 'placeId');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}

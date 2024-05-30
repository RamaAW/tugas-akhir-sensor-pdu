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

    public function records()
    {
        return $this->hasMany(Record::class, 'wellId');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'wellId');
    }
}

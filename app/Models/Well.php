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

    public function rigs()
    {
        return $this->hasMany(Rig::class, 'wellId');
    }

    // public function notifications()
    // {
    //     return $this->hasMany(Notification::class, 'wellId');
    // }

    public function getPlaceNameAttribute()
    {
        return $this->places ? $this->places->name : null;
    }

    public function getCompanyNameAttribute()
    {
        return $this->places && $this->places->companies ? $this->places->companies->name : null;
    }

    public function getCompanyIdAttribute()
    {
        return $this->places && $this->places->companies ? $this->places->companies->id : null;
    }
}

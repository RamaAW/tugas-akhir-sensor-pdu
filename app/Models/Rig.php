<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rig extends Model
{
    protected $fillable = ['id', 'rigName', 'rigType', 'rigPower', 'rigActivity', 'wellId'];

    public function wells()
    {
        return $this->belongsTo(Well::class, 'wellId');
    }

    public function records()
    {
        return $this->hasMany(Record::class, 'RigId');
    }

    public function getWellNameAttribute()
    {
        return $this->wells ? $this->wells->name : null;
    }

    public function getPlaceNameAttribute()
    {
        return $this->wells && $this->wells->places ? $this->wells->places->name : null;
    }

    public function getPlaceIdAttribute()
    {
        return $this->wells && $this->wells->places ? $this->wells->places->id : null;
    }

    public function getCompanyNameAttribute()
    {
        return $this->wells && $this->wells->places->companies ? $this->wells->places->companies->name : null;
    }

    public function getCompanyIdAttribute()
    {
        return $this->wells && $this->wells->places->companies ? $this->wells->places->companies->id : null;
    }
}

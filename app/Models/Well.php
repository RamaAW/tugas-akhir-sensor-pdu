<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Well extends Model
{

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'address', 'latitude', 'longitude', 'placeId'];

    public function places()
    {
        return $this->belongsTo(Place::class, 'placeId');
    }

    public function rigs()
    {
        return $this->hasMany(Rig::class, 'wellId');
    }

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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}

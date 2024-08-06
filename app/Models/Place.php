<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'address', 'latitude', 'longitude', 'companyId'];

    public function wells()
    {
        return $this->hasMany(Well::class, 'placeId');
    }
    public function companies()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
    public function getCompanyNameAttribute()
    {
        return $this->companies ? $this->companies->name : null;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasApiTokens, Notifiable, HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id', 'name', 'username', 'companyId', 'role', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
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

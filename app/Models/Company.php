<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['id', 'name', 'address'];
    protected $keyType = 'string';

    public function places()
    {
        return $this->hasMany(Place::class, 'companyId');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class, 'companyId');
    }
}

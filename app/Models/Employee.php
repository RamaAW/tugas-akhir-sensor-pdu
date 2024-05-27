<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id', 'name', 'email', 'companyId', 'role', 'password'];

    public function companies()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}

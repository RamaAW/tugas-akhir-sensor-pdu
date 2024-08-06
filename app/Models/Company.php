<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    // Menetapkan UUID sebagai tipe kunci utama
    public $incrementing = false;
    protected $keyType = 'string';

    // Mengatur kolom yang dapat diisi massal
    protected $fillable = ['id', 'name', 'address'];

    // Menentukan relasi satu ke banyak dengan model Place
    public function places()
    {
        return $this->hasMany(Place::class, 'companyId');
    }

    // Menentukan relasi satu ke banyak dengan model Employee
    public function employees()
    {
        return $this->hasMany(Employee::class, 'companyId');
    }

    // Menghasilkan UUID secara otomatis jika belum ada
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

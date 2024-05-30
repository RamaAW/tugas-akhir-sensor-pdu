<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'message',
        'wellId',
        'seen'
    ];

    public function wells()
    {
        return $this->belongsTo(Well::class, 'wellId');
    }
}

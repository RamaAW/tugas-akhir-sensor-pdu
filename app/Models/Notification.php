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
        'recordId',
        'seen'
    ];

    public function records()
    {
        return $this->belongsTo(Record::class, 'recordId');
    }
    public function getRigNameAttribute()
    {
        return $this->records && $this->records->rigs ? $this->records->rigs->rigName : null;
    }
    public function getWellNameAttribute()
    {
        return $this->records && $this->records->rigs && $this->records->rigs->wells ? $this->records->rigs->wells->name : null;
    }
}

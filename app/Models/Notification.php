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
    public function getWellNameAttribute()
    {
        return $this->records && $this->records->wells ? $this->records->wells->name : null;
    }
    public function getWellIdAttribute()
    {
        return $this->records && $this->records->wells ? $this->records->wells->id : null;
    }
}

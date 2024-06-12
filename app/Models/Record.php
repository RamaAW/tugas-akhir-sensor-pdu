<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'Date-Time',
        'BitDepth',
        'Scfm',
        'MudCondIn',
        'BlockPos',
        'WOB',
        'ROPi',
        'BVDepth',
        'MudCondOut',
        'Torque',
        'RPM',
        'Hkld',
        'LogDepth',
        'H2S_1',
        'MudFlowOutp',
        'TotSPM',
        'SpPress',
        'MudFlowIn',
        'CO2_1',
        'Gas',
        'MudTempIn',
        'MudTempOut',
        'TankVolTot',
        'WellId'
    ];

    public function wells()
    {
        return $this->belongsTo(Well::class, 'WellId');
    }

    protected $attributes = [
        'BitDepth' => 0,
        'Scfm' => 0,
        'MudCondIn' => 0,
        'BlockPos' => 0,
        'WOB' => 0,
        'ROPi' => 0,
        'BVDepth' => 0,
        'MudCondOut' => 0,
        'Torque' => 0,
        'RPM' => 0,
        'Hkld' => 0,
        'LogDepth' => 0,
        'H2S_1' => 0,
        'MudFlowOutp' => 0,
        'TotSPM' => 0,
        'SpPress' => 0,
        'MudFlowIn' => 0,
        'CO2_1' => 0,
        'Gas' => 0,
        'MudTempIn' => 0,
        'MudTempOut' => 0,
        'TankVolTot' => 0,
    ];
}

<?php

namespace App\Console\Commands;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateDummySensorData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-dummy-sensor-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'Date-Time' => Carbon::now(),
            'BitDepth' => rand(100, 500),
            'Scfm' => rand(500, 1000) / 10,
            'MudCondIn' => rand(20, 50),
            'BlockPos' => rand(0, 100),
            'WOB' => rand(100, 500) / 10,
            'ROPi' => rand(10, 50) / 10,
            'BVDepth' => rand(100, 500),
            'MudCondOut' => rand(20, 50),
            'Torque' => rand(100, 500) / 10,
            'RPM' => rand(100, 500),
            'Hkld' => rand(10, 50),
            'LogDepth' => rand(100, 500),
            'H2S_1' => rand(10, 50) / 10,
            'MudFlowOutp' => rand(100, 500) / 10,
            'TotSPM' => rand(100, 500),
            'SpPress' => rand(10, 50) / 10,
            'MudFlowIn' => rand(100, 500) / 10,
            'CO2_1' => rand(10, 50) / 10,
            'Gas' => rand(100, 500),
            'MudTempIn' => rand(10, 50) / 10,
            'MudTempOut' => rand(10, 50) / 10,
            'TankVolTot' => rand(100, 500) / 10,
            'WellId' => 'well-001'
        ];


        // Store data in records table
        Record::create($data);

        $this->info('Dummy sensor data generated and stored successfully.');

        return 0;
    }
}

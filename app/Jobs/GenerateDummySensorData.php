<?php

namespace App\Jobs;

use App\Models\Record;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Faker\Factory as Faker;

class GenerateDummySensorData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $faker = Faker::create();

        $record = new Record([
            'Date-Time' => $faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            'BitDepth' => $faker->randomFloat(2, 0, 5000),
            'Scfm' => $faker->randomFloat(2, 0, 100),
            'MudCondIn' => $faker->randomFloat(2, 0, 10),
            'BlockPos' => $faker->randomFloat(2, 0, 100),
            'WOB' => $faker->randomFloat(2, 0, 50),
            'ROPi' => $faker->randomFloat(2, 0, 100),
            'BVDepth' => $faker->randomFloat(2, 0, 5000),
            'MudCondOut' => $faker->randomFloat(2, 0, 10),
            'Torque' => $faker->randomFloat(2, 0, 100),
            'RPM' => $faker->randomFloat(2, 0, 200),
            'Hkld' => $faker->randomFloat(2, 0, 1000),
            'LogDepth' => $faker->randomFloat(2, 0, 5000),
            'H2S_1' => $faker->randomFloat(2, 0, 100),
            'MudFlowOutp' => $faker->randomFloat(2, 0, 1000),
            'TotSPM' => $faker->randomFloat(2, 0, 200),
            'SpPress' => $faker->randomFloat(2, 0, 500),
            'MudFlowIn' => $faker->randomFloat(2, 0, 1000),
            'CO2_1' => $faker->randomFloat(2, 0, 100),
            'Gas' => $faker->randomFloat(2, 0, 100),
            'MudTempIn' => $faker->randomFloat(2, 0, 200),
            'MudTempOut' => $faker->randomFloat(2, 0, 200),
            'TankVolTot' => $faker->randomFloat(2, 0, 10000),
            'WellId' => 1 // Sesuaikan dengan ID sumur yang sesuai
        ]);

        $record->save();
    }
}

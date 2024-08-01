<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->dateTime('Date-Time');
            $table->decimal('BitDepth')->nullable();
            $table->decimal('Scfm', 8, 2)->nullable();
            $table->decimal('MudCondIn')->nullable();
            $table->decimal('BlockPos')->nullable();
            $table->decimal('WOB', 8, 2)->nullable();
            $table->decimal('ROPi', 8, 2)->nullable();
            $table->decimal('BVDepth')->nullable();
            $table->decimal('MudCondOut')->nullable();
            $table->decimal('Torque', 8, 2)->nullable();
            $table->decimal('RPM')->nullable();
            $table->decimal('Hkld')->nullable();
            $table->decimal('LogDepth')->nullable();
            $table->decimal('H2S_1', 8, 2)->nullable();
            $table->decimal('MudFlowOutp', 8, 2)->nullable();
            $table->decimal('TotSPM')->nullable();
            $table->decimal('SpPress', 8, 2)->nullable();
            $table->decimal('MudFlowIn', 8, 2)->nullable();
            $table->decimal('CO2_1', 8, 2)->nullable();
            $table->decimal('Gas')->nullable();
            $table->decimal('MudTempIn', 8, 2)->nullable();
            $table->decimal('MudTempOut', 8, 2)->nullable();
            $table->decimal('TankVolTot', 8, 2)->nullable();
            $table->unsignedBigInteger('RigId');
            $table->timestamps();

            $table->foreign('RigId')->references('id')->on('rigs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};

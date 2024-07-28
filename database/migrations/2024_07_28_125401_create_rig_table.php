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
        Schema::create('rig', function (Blueprint $table) {
            $table->id();
            $table->string('rigName');
            $table->string('rigType');
            $table->string('rigPower');
            $table->string('rigActivity');
            $table->string('wellId');
            $table->timestamps();

            $table->foreign('wellId')->references('id')->on('wells');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rig');
    }
};

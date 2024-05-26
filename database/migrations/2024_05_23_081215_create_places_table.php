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
        Schema::create('places', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('address');
            $table->decimal('latitude', 10, 8); // Assuming latitude values have a maximum of 10 digits with 8 decimal places
            $table->decimal('longitude', 11, 8); // Assuming longitude values have a maximum of 11 digits with 8 decimal places
            $table->string('companyId');
            $table->timestamps();

            $table->foreign('companyId')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};

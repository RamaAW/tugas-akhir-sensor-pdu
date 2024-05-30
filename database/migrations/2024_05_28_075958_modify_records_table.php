<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            // Menghapus primary key yang sudah ada (jika ada)
            $table->dropPrimary(['id']);

            // Mengubah kolom id menjadi string dan menambahkan sebagai primary key
            $table->string('id')->primary()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            // Menghapus primary key yang sudah ada (jika ada)
            $table->dropPrimary(['id']);

            // Mengubah kolom id kembali menjadi incrementing integer
            $table->id()->change();
        });
    }
};

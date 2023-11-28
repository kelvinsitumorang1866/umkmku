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
        Schema::create('gagal_panen_telurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Umkm_id');
            $table->foreignId('Produk_id');
            $table->bigInteger('jumlah_gagal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gagal_panen_telurs');
    }
};

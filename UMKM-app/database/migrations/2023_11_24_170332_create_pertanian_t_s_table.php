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
        Schema::create('pertanian_t_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('Umkm_id');
            $table->foreignId('Produk_id');
            $table->bigInteger('jumlah');
            $table->bigInteger('ammount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanian_t_s');
    }
};

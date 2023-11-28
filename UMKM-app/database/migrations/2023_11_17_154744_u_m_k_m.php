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
        Schema::create('umkm_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('User_id');
            $table->string('Nama_umkm');
            $table->string('pemilik');
            $table->string('alamat');
            $table->bigInteger('NIB');
            $table->bigInteger('NPWP');
            $table->timestamp('waktu_berdiri');
            $table->enum('jenis',['Makanan Olahan','Pertanian','Peternakan']);
            $table->bigInteger('Pirt');
            $table->bigInteger('bpom');
            $table->bigInteger('halal');
            $table->bigInteger('merek');
            $table->bigInteger('hak_cipta');
            $table->bigInteger('no1');
            $table->bigInteger('no2')->nullable();
            $table->string('email');
            $table->string('website');
            $table->string('fb');
            $table->string('ig');
            $table->string('tokped');
            $table->string('shopee');
            $table->string('bukalapak');
            $table->bigInteger('Asset');
            $table->bigInteger('omset');
            $table->bigInteger('tenagaL');
            $table->bigInteger('tenagaP');
            $table->string('desa');
            $table->string('kab');
            $table->string('prov');
            $table->string('nas');
            $table->string('exp');
            $table->string('kapasitas');
            $table->enum('status',['Active','Inactive'])->default('Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkm_models');
    }
};

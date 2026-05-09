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
        Schema::create('data_kontrakan', function (Blueprint $table) {
            $table->string('id_kontrakan');
            $table->string('id_pemilik');
            $table->string('nama_kontrakan');
            $table->enum('kategori',['Muslimah','Muslim','Cowok','Cewek']);
            $table->enum('sistem',['Bulanan','Tahunan']);
            $table->string('alamat');
            $table->string('total_kamar');
            $table->string('jumlah_kamar_kosong');
            $table->string('id_wilayah');
            $table->string('harga_bulanan');
            $table->string('harga_tahunan');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('foto4');
            $table->string('foto5');
            $table->enum('panel_utama',['on','off']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kontrakan');
    }
};

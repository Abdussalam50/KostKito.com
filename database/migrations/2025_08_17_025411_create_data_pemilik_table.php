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
        Schema::create('data_pemilik', function (Blueprint $table) {
            $table->string('id_pemilik');
            $table->string('nama');
            $table->string('alamat');
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan']);
            $table->enum('agama',['Islam','Kristen','Katolik','Hindu','Buddha','Khonghucu']);
            $table->string('no_wa');
            $table->string('username');
            $table->string('password');
            $table->enum('status',['expired','aktif']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pemilik');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('ukuran');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('kode_batch')->nullable();
            $table->date('tgl_kedaluwarsa')->nullable();
            $table->text('deskripsi');
            $table->text('komposisi');
            $table->text('manfaat_kesehatan');
            $table->string('kandungan_alergen')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

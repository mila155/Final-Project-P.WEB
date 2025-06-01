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
        Schema::create('stok_keluar', function (Blueprint $table) {
            $table->increments('id_keluar');
            // $table->string('kode_produk', 6)->index('kode_produk');
            $table->string('kode_produk', 6);
            $table->foreign('kode_produk')->references('kode_produk')->on('produk');
            $table->dateTime('tanggal_keluar')->useCurrent();
            $table->integer('jumlah_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_keluar');
    }
};

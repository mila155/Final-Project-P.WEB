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
        Schema::create('stok_masuk', function (Blueprint $table) {
            $table->increments('id_masuk');
            // $table->string('kode_produk', 6)->index('kode_produk');
            $table->string('kode_produk', 6);
            $table->foreign('kode_produk')->references('kode_produk')->on('produk');
            $table->dateTime('tanggal_masuk')->useCurrent();
            $table->integer('jumlah_masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_masuk');
    }
};

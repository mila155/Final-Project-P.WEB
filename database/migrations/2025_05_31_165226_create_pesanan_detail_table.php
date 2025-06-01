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
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pesanan_id')->index('pesanan_id');
            $table->foreign('pesanan_id')->references('id')->on('pesanan');
            $table->string('kode_produk', 6);
            $table->foreign('kode_produk')->references('kode_produk')->on('produk');
            $table->integer('harga');
            $table->integer('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_detail');
    }
};

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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_produk', 6);
            $table->foreign('kode_produk')->references('kode_produk')->on('produk');
            $table->unsignedInteger('user_id')->nullable()->index('user_id');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->string('nama', 100);
            $table->integer('harga');
            $table->integer('jumlah')->nullable()->default(1);
            $table->binary('gambar')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'kode_produk']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};

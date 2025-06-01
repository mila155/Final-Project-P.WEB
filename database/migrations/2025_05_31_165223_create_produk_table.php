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
        Schema::create('produk', function (Blueprint $table) {
            // $table->increments('id');
            $table->string('kode_produk', 6)->primary();
            $table->string('nama_produk')->index('nama_produk');
            $table->integer('stok');
            $table->decimal('harga_jual', 15);
            $table->decimal('harga_produksi', 15);
            $table->integer('kuantitas_produk');
            $table->enum('satuan', ['gram', 'ml']);
            $table->text('deskripsi')->nullable();
            $table->binary('foto')->nullable();
            $table->integer('stok_akhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};

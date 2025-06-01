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
        Schema::table('stok_keluar', function (Blueprint $table) {
            $table->foreign(['kode_produk'], 'stok_keluar_ibfk_1')->references(['kode_produk'])->on('produk')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stok_keluar', function (Blueprint $table) {
            $table->dropForeign('stok_keluar_ibfk_1');
        });
    }
};

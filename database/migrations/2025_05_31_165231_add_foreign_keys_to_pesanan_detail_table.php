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
        Schema::table('pesanan_detail', function (Blueprint $table) {
            $table->foreign(['pesanan_id'], 'pesanan_detail_ibfk_1')->references(['id'])->on('pesanan')->onUpdate('no action')->onDelete('no action');
            
            $table->foreign(['kode_produk'], 'pesanan_detail_ibfk_2')->references(['kode_produk'])->on('produk')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan_detail', function (Blueprint $table) {
            $table->dropForeign('pesanan_detail_ibfk_1');
            $table->dropForeign('pesanan_detail_ibfk_2');
        });
    }
};

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
        Schema::table('keranjang', function (Blueprint $table) {
            $table->foreign(['kode_produk'], 'keranjang_ibfk_1')->references(['kode_produk'])->on('produk')->onUpdate('no action')->onDelete('no action');

            $table->foreign(['user_id'], 'keranjang_ibfk_2')->references(['user_id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keranjang', function (Blueprint $table) {
            $table->dropForeign('keranjang_ibfk_1');
            $table->dropForeign('keranjang_ibfk_2');
        });
    }
};

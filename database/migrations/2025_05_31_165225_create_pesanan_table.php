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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user')->nullable()->index('id_user');
            $table->foreign('id_user')->references('user_id')->on('users');
            $table->string('nama', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 30)->nullable();
            $table->dateTime('tanggal')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};

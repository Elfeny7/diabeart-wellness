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
            $table->unsignedBigInteger('id_produk')->nullable();
            $table->foreign('id_produk')->references('id')->on('produk');
            $table->unsignedBigInteger('id_transaksi')->nullable();
            $table->foreign('id_transaksi')->references('id')->on('transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keranjang', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
            $table->dropForeign(['id_transaksi']);
        });
    }
};

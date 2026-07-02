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
        Schema::table('ec_keranjang', function (Blueprint $table) {
            $table->foreign(['barang_id'], 'fk_cart_produk')->references(['barang_id'])->on('ec_produk')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'fk_cart_user')->references(['user_id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ec_keranjang', function (Blueprint $table) {
            $table->dropForeign('fk_cart_produk');
            $table->dropForeign('fk_cart_user');
        });
    }
};

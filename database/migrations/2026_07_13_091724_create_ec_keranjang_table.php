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
        Schema::create('ec_keranjang', function (Blueprint $table) {
            $table->integer('keranjang_id', true);
            $table->integer('user_id')->index('fk_cart_user');
            $table->integer('barang_id')->index('fk_cart_produk');
            $table->integer('qty')->nullable()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_keranjang');
    }
};

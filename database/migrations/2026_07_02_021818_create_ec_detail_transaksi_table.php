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
        Schema::create('ec_detail_transaksi', function (Blueprint $table) {
            $table->integer('detail_id', true);
            $table->integer('transaksi_id')->index('fk_detail_trans');
            $table->integer('barang_id')->index('fk_detail_prod');
            $table->integer('qty');
            $table->integer('harga_satuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_detail_transaksi');
    }
};

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
        Schema::table('ec_detail_transaksi', function (Blueprint $table) {
            $table->foreign(['barang_id'], 'fk_detail_prod')->references(['barang_id'])->on('ec_produk')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['transaksi_id'], 'fk_detail_trans')->references(['transaksi_id'])->on('ec_transaksi')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ec_detail_transaksi', function (Blueprint $table) {
            $table->dropForeign('fk_detail_prod');
            $table->dropForeign('fk_detail_trans');
        });
    }
};

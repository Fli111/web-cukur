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
        Schema::create('ec_transaksi', function (Blueprint $table) {
            $table->integer('transaksi_id', true);
            $table->string('order_id')->unique();
            $table->integer('user_id')->index('fk_ec_trans_user');
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->integer('total_harga');
            $table->integer('diskon_persen')->default(0);
            $table->integer('potongan_harga')->default(0);
            $table->text('alamat_pengiriman');
            $table->string('metode_pembayaran', 50);
            $table->string('opsi_pengiriman', 50);
            $table->string('status_pesanan', 20)->nullable()->default('Pending');
            $table->string('payment_status')->default('pending');
            $table->string('snap_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_transaksi');
    }
};

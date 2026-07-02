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
        Schema::create('mem_transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', true);
            $table->integer('user_id')->index('fk_memtrans_user');
            $table->string('nama', 100)->nullable();
            $table->string('jenis', 20)->nullable();
            $table->dateTime('waktu_pembayaran')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mem_transaksi');
    }
};

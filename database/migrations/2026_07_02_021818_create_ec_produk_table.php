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
        Schema::create('ec_produk', function (Blueprint $table) {
            $table->integer('barang_id', true);
            $table->string('nama_produk', 50)->nullable();
            $table->string('kategori', 50)->nullable();
            $table->integer('harga')->nullable();
            $table->integer('stok')->nullable();
            $table->string('gambar_produk', 100)->nullable();
            $table->text('deskripsi_produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ec_produk');
    }
};

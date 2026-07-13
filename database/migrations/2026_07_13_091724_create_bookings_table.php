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
        Schema::create('bookings', function (Blueprint $table) {
            $table->integer('book_id', true);
            $table->integer('user_id')->nullable()->index('fk_booking_user');
            $table->integer('barber_id')->nullable()->index('fk_booking_barber');
            $table->integer('service_id')->nullable()->index('fk_booking_service');
            $table->date('tanggal')->nullable();
            $table->time('waktu')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'done', 'cancelled'])->nullable()->default('pending');
            $table->integer('harga_final')->nullable();
            $table->integer('diskon_persen')->default(0);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreign(['barber_id'], 'fk_booking_barber')->references(['barber_id'])->on('barbers')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['service_id'], 'fk_booking_service')->references(['service_id'])->on('services')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['user_id'], 'fk_booking_user')->references(['user_id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign('fk_booking_barber');
            $table->dropForeign('fk_booking_service');
            $table->dropForeign('fk_booking_user');
        });
    }
};

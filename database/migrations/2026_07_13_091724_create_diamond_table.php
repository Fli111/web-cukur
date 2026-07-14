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
        Schema::create('diamond', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('fk_diamond_user');
            $table->string('nama', 100);
            $table->string('gmail', 100);
            $table->string('diamond_id', 20)->nullable();
            $table->dateTime('tgl_daftar')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diamond');
    }
};

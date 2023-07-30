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
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('jasa_id');
            $table->date('tanggal_booking');
            $table->foreign('pemesanan_id')->references('id')->on('pemesanan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jasa_id')->references('id')->on('jasa')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};

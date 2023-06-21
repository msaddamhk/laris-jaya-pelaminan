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
        Schema::create('pemesanan_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_id');
            $table->unsignedBigInteger('jasa_id');
            $table->unsignedBigInteger('jumlah');
            $table->timestamps();
            $table->foreign('pemesanan_id')->references('id')->on('pemesanan');
            $table->foreign('jasa_id')->references('id')->on('jasa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_item');
    }
};

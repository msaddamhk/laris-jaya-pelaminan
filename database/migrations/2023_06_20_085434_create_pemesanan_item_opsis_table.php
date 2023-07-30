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
        Schema::create('pemesanan_item_opsi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemesanan_item_id');
            $table->unsignedBigInteger('jasa_opsi_item_id');
            $table->timestamps();
            $table->foreign('pemesanan_item_id')->references('id')->on('pemesanan_item')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('jasa_opsi_item_id')->references('id')->on('jasa_opsi_item')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_item_opsi');
    }
};

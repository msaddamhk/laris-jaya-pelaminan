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
        Schema::create('jasa_opsi_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opsi_jasa_id');
            $table->string('label');
            $table->string('value');
            $table->integer('modal')->default(0);
            $table->integer('harga')->default(0);
            $table->timestamps();
            $table->foreign('opsi_jasa_id')->references('id')->on('jasa_opsi')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_opsi_item');
    }
};

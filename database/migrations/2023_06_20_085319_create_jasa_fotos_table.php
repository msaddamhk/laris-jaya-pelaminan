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
        Schema::create('jasa_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jasa_id');
            $table->string('foto');
            $table->timestamps();
            $table->foreign('jasa_id')->references('id')->on('jasa')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasa_foto');
    }
};

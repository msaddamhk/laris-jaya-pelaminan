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
        Schema::create('jasa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('modal')->default(0);
            $table->integer('harga')->default(0);
            $table->string('tipe_unit');
            $table->boolean('is_cod')->default(false);
            $table->boolean('banyak_hari')->default(false);
            $table->integer('jumlah_minimal');
            $table->integer('jumlah_maksimal');
            $table->foreign('vendor_id')->references('id')->on('vendor')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jasas');
    }
};

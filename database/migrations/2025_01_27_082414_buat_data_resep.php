<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->string('link')->nullable();
            $table->string('waktu');
            $table->string('kesulitan');
            $table->string('porsi');
            $table->text('bahan');
            $table->text('langkah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reseps');
    }
};

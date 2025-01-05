<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('jurusan_peserta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peserta');
            $table->unsignedBigInteger('id_jurusan');
            $table->timestamps();

            $table->foreign('id_peserta')->references('id_peserta')->on('peserta');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan');
        });
    }
};

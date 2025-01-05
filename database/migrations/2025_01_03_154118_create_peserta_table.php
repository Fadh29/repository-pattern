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
    Schema::create('peserta', function (Blueprint $table) {
        $table->id('id_peserta');
        $table->string('nama_peserta');
        $table->enum('jenis_kelamin_peserta', ['L', 'P']);
        $table->text('alamat_peserta');
        $table->string('email_peserta')->unique();
        $table->string('password');
        $table->timestamps();
    });
}

};

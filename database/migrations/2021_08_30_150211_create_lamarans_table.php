<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('profil_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('dokumen')->nullable();
            $table->string('nama_lowongan')->nullable();
            $table->string('waktu_berakhir')->nullable();
            $table->string('status_lamaran')->nullable();
            $table->unsignedBigInteger('perusahaan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lamarans');
    }
}

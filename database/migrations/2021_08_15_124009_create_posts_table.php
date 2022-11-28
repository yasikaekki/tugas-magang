<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('bidang_pekerjaan_id');
            $table->foreignId('perusahaan_id');
            $table->string('nama_perusahaan');
            $table->string('alamat_perusahaan');
            $table->string('judul_pekerjaan');
            // $table->string('bidang_pekerjaan');
            $table->string('employee');
            $table->string('deskripsi_pekerjaan');
            $table->string('persyaratan');
            $table->string('masa_berakhir');
            $table->string('foto');
            $table->string('pelamar')->nullable();
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
        Schema::dropIfExists('posts');
    }
}

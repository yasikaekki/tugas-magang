<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerusahaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama_perusahaan')->nullable();
            $table->string('ubah_foto')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('jumlah_karyawan')->nullable();
            $table->string('tentang_perusahaan')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('telepon')->nullable();
            $table->string('industri')->nullable();
            $table->string('nib')->nullable();
            $table->string('siup')->nullable();
            $table->string('akta_perusahaan')->nullable();
            $table->string('lokasi_foto')->nullable();
            $table->string('lokasi_nib')->nullable();
            $table->string('lokasi_siup')->nullable();
            $table->string('lokasi_akta')->nullable();
            $table->string('post_id')->nullable();
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
        Schema::dropIfExists('perusahaans');
    }
}

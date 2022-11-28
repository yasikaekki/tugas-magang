<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('ubah_foto')->nullable();
            $table->string('nama_lengkap')->nullable();
            $table->string('tentang_saya')->nullable();
            $table->string('pendidikan_user')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('alamat_rumah')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->float('telepon', 13, 2)->nullable();
            $table->string('surat_keterangan')->nullable();
            $table->string('cv')->nullable();
            $table->string('portofolio')->nullable();
            $table->string('lokasi_foto')->nullable();
            $table->string('lokasi_sk')->nullable();
            $table->string('lokasi_cv')->nullable();
            $table->string('lokasi_portofolio')->nullable();
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
        Schema::dropIfExists('profils');
    }
}

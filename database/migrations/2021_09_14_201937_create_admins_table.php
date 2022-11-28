<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
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
            $table->string('pekerjaan')->nullable();
            $table->string('keahlian')->nullable();
            $table->string('lokasi_foto')->nullable();
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
        Schema::dropIfExists('admins');
    }
}

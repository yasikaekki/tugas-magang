<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;
use App\Model\Admin;
use App\Model\Profil;
use App\Perusahaan;

class MakeUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |-------------------------------------------|
        |run = php artisan db:seed --class=MakeUser |
        |-------------------------------------------|
        */

        $faker = Faker::create('en_US');

        $array = ['admin', 'user', 'perusahaan'];
        $jenis_kelamin = ['laki laki', 'perempuan'];
        $pendidikan = ['Mahasiswa', 'SMA/SMK sederajat'];
        // echo "\033[33m\n Tekan 0 untuk keluar \033[0m \n masukkan jumlah user dibuat :";
        echo "\033[33m\n Pilih\n 1. create random user\n 2. create admin\n 3. create user\n 4. create perusahaan\n 5. create biodata\n 6. create postingan\n 7. lamaran\n 0. keluar \033[0m \n masukkan jumlah user dibuat :";
        $isi = trim(fgets(STDIN));
        // $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
        

        if($isi == 1){
            echo "\033[33m\n Pilih\n 1. non verify random user\n 2. verify random user\n 0. keluar \033[0m \n masukkan jumlah user dibuat :";
            $isi = trim(fgets(STDIN));
            if($isi == 1){
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = $randomrole;
                            $user->created_at = \Carbon\Carbon::now();
                            $user->save();
                            
                            if($user->role == 'admin'){
                                $admin = new Admin;
                                $admin->user_id = $user->id;
                                $admin->created_at = \Carbon\Carbon::now();
                                $admin->save();
                            }elseif($user->role == 'user'){
                                $profil = new Profil;
                                $profil->user_id = $user->id;
                                $profil->created_at = \Carbon\Carbon::now();
                                $profil->save();
                            }elseif($user->role == 'perusahaan'){
                                $perusahaan = new Perusahaan;
                                $perusahaan->user_id = $user->id;
                                $perusahaan->created_at = \Carbon\Carbon::now();
                                $perusahaan->save();
                            }else{
                                echo "\033[31m\n gagal \033[0m";
                            }
                        }
                    }
                }
            }elseif($isi == 2) {
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = $randomrole;
                            $user->created_at = \Carbon\Carbon::now();
                            $user->email_verified_at = \Carbon\Carbon::now();
                            $user->save();
                            
                            if($user->role == 'admin'){
                                $admin = new Admin;
                                $admin->user_id = $user->id;
                                $admin->created_at = \Carbon\Carbon::now();
                                $admin->save();
                            }elseif($user->role == 'user'){
                                $profil = new Profil;
                                $profil->user_id = $user->id;
                                $profil->created_at = \Carbon\Carbon::now();
                                $profil->save();
                            }elseif($user->role == 'perusahaan'){
                                $perusahaan = new Perusahaan;
                                $perusahaan->user_id = $user->id;
                                $perusahaan->created_at = \Carbon\Carbon::now();
                                $perusahaan->save();
                            }else{
                                echo "\033[31m\n gagal \033[0m";
                            }
                        }
                    }
                }
            }elseif(is_numeric($isi) == 0) {
                echo "Yang dimasukkan bukan angka";
            }else {
                echo "Yang anda masukkan salah";
            }
        }elseif ($isi == 2) {
            echo "\033[33m\n Pilih\n 1. non verify admin\n 2. verify admin\n 0. keluar \033[0m \n masukkan pilihan: ";
            $isi = trim(fgets(STDIN));
            if($isi == 1){
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'admin';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->save();

                            $admin = new Admin;
                            $admin->user_id = $user->id;
                            $admin->created_at = \Carbon\Carbon::now();
                            $admin->save();
                        }
                    }
                }
            }elseif($isi == 2) {
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'admin';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->email_verified_at = \Carbon\Carbon::now();
                            $user->save();

                            $admin = new Admin;
                            $admin->user_id = $user->id;
                            $admin->created_at = \Carbon\Carbon::now();
                            $admin->save();
                        }
                    }
                }
            }elseif(is_numeric($isi) == 0) {
            }
        }elseif ($isi == 3) {
            echo "\033[33m\n Pilih\n 1. non verify user\n 2. verify user\n 0. keluar \033[0m \n masukkan pilihan: ";
            $isi = trim(fgets(STDIN));
            if($isi == 1){
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'user';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->save();

                            $profil = new Profil;
                            $profil->user_id = $user->id;
                            $profil->created_at = \Carbon\Carbon::now();
                            $profil->save();
                        }
                    }
                }
            }elseif($isi == 2) {
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'user';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->email_verified_at = \Carbon\Carbon::now();
                            $user->save();

                            $profil = new Profil;
                            $profil->user_id = $user->id;
                            $profil->created_at = \Carbon\Carbon::now();
                            $profil->save();
                        }
                    }
                }
            }elseif(is_numeric($isi) == 0) {
            }
        }elseif ($isi == 4) {
            echo "\033[33m\n Pilih\n 1. non verify perusahaan\n 2. verify perusahaan\n 0. keluar \033[0m \n masukkan pilihan: ";
            $isi = trim(fgets(STDIN));
            if($isi == 1){
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'perusahaan';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->save();

                            $perusahaan = new Perusahaan;
                            $perusahaan->user_id = $user->id;
                            $perusahaan->created_at = \Carbon\Carbon::now();
                            $perusahaan->save();
                        }
                    }
                }
            }elseif($isi == 2) {
                echo "masukkan jumlah: ";
                $isi = trim(fgets(STDIN));
                if(is_numeric($isi) == 0){
                    $berhenti = "\033[31m\n Yang dimasukkan bukan angka \033[0m";
                    die($berhenti);
                }else {
                    if($isi < 0){
                        $berhenti = "\033[31m\n Yang dimasukkan kurang dari 0 \033[0m";
                        die($berhenti);
                    }elseif($isi == 0){
                        $berhenti = "\033[92m\n Keluar..... \033[0m";
                        echo $berhenti;
                        sleep(1);
                        die();
                    }else{
                        echo "\033[92m\n Tunggu, sedang membuat...! \n \033[0m";
                        for($k = 1; $k <= $isi; $k++){
                            $randomrole = Arr::random($array);
                
                            $user = new User;
                            $user->name = $faker->name;
                            $user->email = $faker->email;
                            $user->password = Hash::make('123');
                            $user->role = 'perusahaan';
                            $user->created_at = \Carbon\Carbon::now();
                            $user->email_verified_at = \Carbon\Carbon::now();
                            $user->save();

                            $perusahaan = new Perusahaan;
                            $perusahaan->user_id = $user->id;
                            $perusahaan->created_at = \Carbon\Carbon::now();
                            $perusahaan->save();
                        }
                    }
                }
            }elseif(is_numeric($isi) == 0) {
            }
        }elseif ($isi == 5) {
            echo "\033[33m\n Pilih\n 1. Admin\n 2. User\n 3. Perusahaan\n 0. keluar \033[0m \n masukkan user id untuk mengisi biodata: ";
            $isi = trim(fgets(STDIN));
            if(is_numeric($isi) == 0){
                echo "yang anda masukkan bukan angka";
            }elseif ($isi < 1){
                echo "yang anda masukkan kurang dari 1";
            }elseif ($isi == 1){
                echo "\033[33m\n Profil Admin\n Pilih\n 0. keluar \033[0m \n masukkan user id untuk mengisi biodata: ";
                $isi = trim(fgets(STDIN));
                $randomgender = Arr::random($jenis_kelamin);
                $randompendidikan = Arr::random($pendidikan);
                $profil = Admin::find($isi);
                $profil->nama_lengkap = $faker->name;
                $profil->tentang_saya = $faker->name;
                $profil->pendidikan_user = $randompendidikan;
                $profil->tempat_lahir = $faker->country;
                $profil->tanggal_lahir = $faker->date;
                $profil->alamat_rumah = $faker->streetAddress;
                $profil->jenis_kelamin = $randomgender;
                $profil->telepon = "085555999555";
                // $profil = Profil::where('user_id', $isi);
                // $profil->ubah_foto = $faker->imageUrl;
                // $profil->lokasi_foto = $faker->image;
                $profil->update();
            }elseif ($isi == 2){
                echo "\033[33m\n Profil User\n Pilih\n 0. keluar \033[0m \n masukkan user id untuk mengisi biodata: ";
                $isi = trim(fgets(STDIN));
                $randomgender = Arr::random($jenis_kelamin);
                $randompendidikan = Arr::random($pendidikan);
                $profil = Profil::find($isi);
                $profil->nama_lengkap = $faker->name;
                $profil->tentang_saya = $faker->name;
                $profil->pendidikan_user = $randompendidikan;
                $profil->tempat_lahir = $faker->country;
                $profil->tanggal_lahir = $faker->date;
                $profil->alamat_rumah = $faker->streetAddress;
                $profil->jenis_kelamin = $randomgender;
                $profil->telepon = "085555999555";
                // $profil = Profil::where('user_id', $isi);
                // $profil->ubah_foto = $faker->imageUrl;
                // $profil->lokasi_foto = $faker->image;
                $profil->update();
            }elseif ($isi == 3){
                echo "\033[33m\n Profil Perusahaan\n Pilih\n 0. keluar \033[0m \n masukkan user id untuk mengisi biodata: ";
                $isi = trim(fgets(STDIN));
                $profil = Perusahaan::find($isi);

                $profil->nama_perusahaan = $faker->company;
                $profil->alamat_perusahaan = $faker->streetAddress;
                $profil->tentang_perusahaan = $faker->name;
                $profil->jumlah_karyawan = 10;
                $profil->no_npwp = "0989";
                $profil->industri = "Sumber Daya Manusia";
                $profil->telepon = "085555999555";
                // $profil = Profil::where('user_id', $isi);
                // $profil->ubah_foto = $faker->imageUrl;
                // $profil->lokasi_foto = $faker->image;
                $profil->update();
            }
        }elseif ($isi == 6) {
            echo "\033[33m\n Pilih\n 0. keluar \033[0m \n masukkan user id untuk mengisi biodata: ";
            $isi = trim(fgets(STDIN));
        }elseif ($isi == 7){
            echo "\033[33m\n maaf sedang perbaikan\n Pilih\n 0. keluar \033[0m \n masukkan pilihan: ";
            $isi = trim(fgets(STDIN));
        }
    }
}

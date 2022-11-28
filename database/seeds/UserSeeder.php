<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\User;
use App\Model\Admin;
use App\Model\Profil;
use App\Perusahaan;

class UserSeeder extends Seeder
{
    public function run()
    {
        // deklarasi super admin
        DB::table('users')->insert([
            'name' => 'super admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'super admin',
            'created_at' => \Carbon\Carbon::now(),
            'email_verified_at' => \Carbon\Carbon::now()
        ]);
        
        // deklarasi verifikasi super admin
        DB::table('user_status_verifies')->insert([
            'user_id' => '1',
            'status' => '2',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        // deklarasi bidang pekerjaan
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'Administrasi Server',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'Web Developer',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'App Developer',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'System Security',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'System Analyst',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'Data Analyst',
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('bidang_pekerjaans')->insert([
            'bidang_pekerjaan' => 'Lainnya',
            'created_at' => \Carbon\Carbon::now(),
        ]);


        // deklarasi email verif dan non verif
        DB::table('verify_emails')->insert([
            'status' => 'Belum Verifikasi',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('verify_emails')->insert([
            'status' => 'Telah Verifikasi',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        $faker = Faker::create('id_ID');
 

        /*
        |---------------------- jarak ------------------------|
        */

        
        // $array = ['admin', 'user', 'perusahaan'];
        // echo "masukkan jumlah user dibuat :";
        // $isi = trim(fgets(STDIN));

    	// for($k = 1; $k <= $isi; $k++){
        //     $randomrole = Arr::random($array);

        //     $user = new User;
        //     $user->name = $faker->name;
        //     $user->email = $faker->email;
        //     $user->password = Hash::make('123');
        //     $user->role = $randomrole;
        //     $user->created_at = \Carbon\Carbon::now();
        //     $user->email_verified_at = \Carbon\Carbon::now();
        //     $user->save();
            
        //     if($user->role == 'admin'){
        //         $admin = new Admin;
        //         $admin->user_id = $user->id;
        //         $admin->created_at = \Carbon\Carbon::now();
        //         $admin->save();
        //     }elseif($user->role == 'user'){
        //         $profil = new Profil;
        //         $profil->user_id = $user->id;
        //         $profil->created_at = \Carbon\Carbon::now();
        //         $profil->save();
        //     }elseif($user->role == 'perusahaan'){
        //         $perusahaan = new Perusahaan;
        //         $perusahaan->user_id = $user->id;
        //         $perusahaan->created_at = \Carbon\Carbon::now();
        //         $perusahaan->save();
        //     }else{
        //         echo "gagal";
        //     }
    	// }

        // DB::table('users')->insert([
        //     'name' => 'User',
        //     'email' => 'user@gmail.com',
        //     'password' => Hash::make('123'),
        //     'role' => 'user',
        //     'created_at' => \Carbon\Carbon::now(),
        //     'email_verified_at' => \Carbon\Carbon::now()
        // ]);
        // DB::table('users')->insert([
        //     'name' => 'Perusahaan',
        //     'email' => 'perusahaan@gmail.com',
        //     'password' => Hash::make('123'),
        //     'role' => 'perusahaan',
        //     'created_at' => \Carbon\Carbon::now(),
        //     'email_verified_at' => \Carbon\Carbon::now()
        // ]);

        //pembuatan profil
        // DB::table('admins')->insert([
        //     'user_id' => '1',
        //     'created_at' => \Carbon\Carbon::now(),
        // ]);
        
        // DB::table('profils')->insert([
        //     'user_id' => '2',
        //     'created_at' => \Carbon\Carbon::now(),
        //     'created_at' => \Carbon\Carbon::now(),
        // ]);
        
        // DB::table('perusahaans')->insert([
        //     'user_id' => '3',
        //     'created_at' => \Carbon\Carbon::now(),
        //     'created_at' => \Carbon\Carbon::now(),
        // ]);


    }
}

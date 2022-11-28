<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Pemberitahuan;
use Carbon\Carbon;
use App\User;
use App\Perusahaan;
use App\UserStatusVerify;
use App\Model\RoleUser;
use App\Model\Profil;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:1', 'confirmed'],
            // 'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:6', 'confirmed'],
            

            'selectrole' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['selectrole'],
            'password' => Hash::make($data['password']),
        ]);

        $roleuser = $user->role;
        $uid = $user->id;
        
        
        $membuat = "membuat akun baru";
        $sekarang = Carbon::now()->isoFormat('dddd, D MMMM Y');
        $createpemberitahuan = new Pemberitahuan;
        $createpemberitahuan->user_id = $uid;
        // $createcompany->aktifitas = $membuat;
        // $createcompany->waktu = $sekarang;
        $createpemberitahuan->save();
        
        
        $createrole = new RoleUser;
        $createrole->user_id = $uid;
        if($roleuser == 'admin'){
            $createrole->role_id = 1;
        }else if($roleuser == 'user'){
            $createprofil = new Profil;
            $createprofil->user_id = $uid;
            $createprofil->save();
            $createrole->role_id = 2;
        }else if($roleuser == 'perusahaan'){
            $createcompany = new Perusahaan;
            $createcompany->user_id = $uid;
            $createcompany->save();
            $createrole->role_id = 3;
        }
        $createrole->save();
        
        $statusverif = new UserStatusVerify;
        $statusverif->user_id = $uid;
        $statusverif->status = '1';
        $statusverif->save();


        // $user = new User;
        // $user->role = RoleUser::find($uid)->where('id', $uid)->select;


        return $user;
    }

    // public function verifyUser($token)
    // {
    // $verifyUser = VerifyUser::where('token', $token)->first();
    // if(isset($verifyUser) ){
    //     $user = $verifyUser->user;
    //     if(!$user->verified) {
    //     $verifyUser->user->verified = 1;
    //     $verifyUser->user->save();
    //     $status = "Your e-mail is verified. You can now login.";
    //     } else {
    //     $status = "Your e-mail is already verified. You can now login.";
    //     }
    // } else {
    //     return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    // }
    // return redirect('/login')->with('status', $status);
    // }
}

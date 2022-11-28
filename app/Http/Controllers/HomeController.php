<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth','verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        // if ($request->user()->hasRole('user')) {
        //     return redirect('user');
        // }

        // if ($request->user()->hasRole('admin')){
        //     return redirect('admin');
        // }

        // if ($request->user()->hasRole('admin')){
        //     return redirect('perusahaan');
        // }
    }
}

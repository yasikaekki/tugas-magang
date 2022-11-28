<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ChartController extends Controller
{
    //
    public function index()
    {
        $users = User::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
          
        return view('chart', compact('users'));
    }
}

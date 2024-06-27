<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $role=Auth::user()->role;
        if($role=='1') 
        {
            return view('pages.client.dashboard.index');
        } else {
            return view('dashboard');
        }
    }
}

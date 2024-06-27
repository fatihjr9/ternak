<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class CustomerAdminController extends Controller
{
    public function index() {
        $data = Checkout::latest()->get();
        return view('pages.admin.customer.index', compact('data'));
        // 
    }
}

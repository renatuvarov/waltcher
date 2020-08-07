<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $ordersCount = DB::table('orders')->count();
        $activeOrdersCount = DB::table('orders')->where('viewed', false)->count();
        return view('admin.home', compact('ordersCount', 'activeOrdersCount'));
    }
}

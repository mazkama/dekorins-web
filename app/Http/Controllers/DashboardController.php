<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Dekorin;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalCategories'   => Category::count(),
            'totalDekorins'     => Dekorin::count(),
            'totalTransactions' => Transaction::count(),
            'totalUsers'        => User::count(),
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduct = Product::count();
        $totalOrder = Order::count();
        $totalBrand = Brand::count();
        $totalTeam = Team::count();

        return view('pages.admin.dashboard', compact('totalProduct', 'totalOrder', 'totalBrand', 'totalTeam'));
    }
}

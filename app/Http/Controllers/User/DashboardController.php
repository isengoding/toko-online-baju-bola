<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalOrder = Order::query()->where('user_id', auth()->id())->count();
        $orderPending = Order::query()
            ->where('user_id', auth()->id())
            ->where('status_payment', 'PENDING')
            ->count();
        $orderPaid = Order::query()
            ->where('user_id', auth()->id())
            ->where('status_payment', 'PAID')
            ->count();

        return view('pages.user.dashboard', compact('totalOrder', 'orderPending', 'orderPaid'));
    }
}

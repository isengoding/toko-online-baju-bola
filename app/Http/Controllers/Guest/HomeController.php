<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = \App\Models\Product::all();
        $teams = \App\Models\Team::all();

        $popularProducts = \App\Models\Product::inRandomOrder()->take(8)->get();
        $carouselProducts = \App\Models\Product::inRandomOrder()->take(5)->get();

        return view('pages.guest.homepage', compact('products', 'teams', 'popularProducts', 'carouselProducts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = product::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('created_at', 'desc')->with('products')->withCount('products')->get();
        return view('home', compact('products', 'categories'));
    }

    public function categoryindex()
    {
        $products = product::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $categories = Category::orderBy('created_at', 'desc')->with('products')->withCount('products')->get();
        return view('categories', compact('products', 'categories'));
    }
}

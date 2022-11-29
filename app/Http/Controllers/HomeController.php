<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        $post = Post::where('tampilPost', 1)->get();
        if (Auth::user()->role == "Admin") {
            return view('beranda.tampil', compact('post'));
        }elseif (Auth::user()->role == "Editor") {
            return view('beranda.tampil', compact('post'));
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
	{
		$sliders = Post::latest()->active()->take(5)->get();
		$posts = Post::latest()->approved()->active()->take(6)->get();
		$recentPosts = Post::latest()->approved()->active()->take(4)->get();
		return view('home',compact('sliders', 'posts', 'recentPosts'));
	}
	
}

<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

	public function index()
	{
		$posts = Post::latest()->approved()->active()->paginate(9);
		return view('posts', compact('posts'));
	}

	public function destails($slug)
	{
		$categories = Category::all();
		$tags = Tag::all();
		$post = Post::where('slug', $slug)->approved()->active()->first();

		// view counter with session
		$blogKey = 'blog_' . $post->id;
		if (!Session::has($blogKey)) {
			$post->increment('view_count');
			Session::put($blogKey, 1);
		}
		// view counter with session

		$randomPosts = Post::inRandomOrder()->approved()->active()->limit(3)->get();
		$recentPosts = Post::latest()->approved()->active()->take(1)->get();
		return view('post', compact('post', 'randomPosts', 'recentPosts', 'categories', 'tags'));
	}


	public function postByCategory($slug)
	{
		$categories = Category::where('slug', $slug)->first();
		$posts = $categories->posts()->latest()->approved()->active()->get();
		return view('category', compact('categories', 'posts'));
	}
	
	public function postByTag($slug)
	{
		$tags = Tag::where('slug', $slug)->first();
		$posts = $tags->posts()->latest()->approved()->active()->get();
		return view('tag', compact('tags', 'posts'));
	}
}

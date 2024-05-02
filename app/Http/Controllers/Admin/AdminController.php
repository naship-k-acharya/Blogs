<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class AdminController extends Controller
{
	public function index()
	{
		$posts = Post::all();
		$comments=Comment::all();
		$popular = Post::withCount('comments')
			->withCount('favorite_users')
			->orderBy('view_count', 'desc')
			->orderBy('comments_count', 'desc')
			->orderBy('favorite_users_count', 'desc')
			->take(5)->get();

		$pending_posts = Post::where('status', 'inactive')->count();
		$all_post_views = Post::sum('view_count');
		$user_count = User::where('role', 'user')->count();
		$new_user_today = User::where('role', 'user')->whereDate('created_at', Carbon::today())->count();
		$active_user = User::where('role', 'user')
			->withCount('posts')
			->withCount('comments')
			->withCount('favorite_posts')
			->orderBy('posts_count', 'desc')
			->orderBy('comments_count', 'desc')
			->orderBy('favorite_posts_count', 'desc')
			->take(10)->get();

		$categories_count = Category::all()->count();
		$tags_count = Tag::all()->count();

		return view('admin.dashboard', compact('posts', 'popular', 'comments', 'pending_posts', 'all_post_views', 'user_count', 'new_user_today', 'active_user', 'categories_count', 'tags_count'));
	
	}


	
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
	public function index()
	{
		$posts = Post::whereHas('favorite_users')->get();
		return view('admin.favorite.index', compact('posts'));
	}
	public function remove(Post $post)
    {
        // Remove the post from the user's favorites
        Auth::user()->favorite_posts()->detach($post);

        return redirect()->back()->with('success', 'Post removed from favorites successfully');
    }
}

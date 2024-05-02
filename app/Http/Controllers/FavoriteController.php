<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class FavoriteController extends Controller
{
	public function add($post)
	{
	    $user = Auth::user(); 

        if (!$user) {
            Toastr::info('To add favorites, you need to log in first!', '', ['progressBar' => true]);
            return redirect()->back();
        }

        $isFavorite = $user->favorite_posts()->where('post_id', $post)->count();

        if ($isFavorite == 0) {
            $user->favorite_posts()->attach($post);
            Toastr::success('You successfully added to your favorite list');
        } else {
            $user->favorite_posts()->detach($post);
            Toastr::success('You successfully removed from your favorite list');
        }

        return redirect()->back();
    
	}
}

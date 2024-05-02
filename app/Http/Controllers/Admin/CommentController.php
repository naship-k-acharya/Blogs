<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	public function index()
	{
		$comments = Comment::latest()->get();
		return view('admin.comment.index', compact('comments'));
	}


	public function destroy(string $id)
	{
		Comment::findOrFail($id)->delete();
		Toastr::success('Comment Successfully Delete');
		return redirect()->back();
	}
	
}

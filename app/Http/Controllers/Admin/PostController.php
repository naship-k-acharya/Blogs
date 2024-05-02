<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AuthorPostApprove;
use App\Notifications\NewPostNotify;
use Illuminate\Support\Facades\Notification;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$post = Post::latest()->get();
		return view('admin.post.index', compact('post'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		$category = Category::all();
		$tag = Tag::all();
		return view('admin.post.create', compact('category', 'tag'));
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title'					=> 'required|unique:posts',
			'image'					=> 'required|mimes:jpg,jpeg,png|max:3072',
			'categories'		=> 'required',
			'tags'					=> 'required',
			'body'					=> 'required',
		]);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check post dir is exists
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}
			// resize image for post add upload
			$setImage = Image::make($image)->resize(1600, 1066)->stream();
			Storage::disk('public')->put('post/' . $imageName, $setImage);

			// check post thumbnail dir is exists
			if (!Storage::disk('public')->exists('post/thumbnail')) {
				Storage::disk('public')->makeDirectory('post/thumbnail');
			}
			// resize image thumbnail for post add upload
			$setImageThumbnail = Image::make($image)->resize(560, 360)->stream();
			Storage::disk('public')->put('post/thumbnail/' . $imageName, $setImageThumbnail);
		} else {
			$imageName = 'default.png';
		}

		$post = new Post();
		$post->user_id	= Auth::id();
		$post->title		= $request->title;
		$post->slug			= $slug;
		$post->image		= $imageName;
		$post->body			= $request->body;

		if (isset($request->status)) {
			$post->status	= 'active';
		} else {
			$post->status	= 'inactive';
		}

		$post->is_approved = 'true';
		$post->save();


		$post->category()->attach($request->categories);
		$post->tag()->attach($request->tags);


		// Admin SMTP mail server
		//lets use here notification

		Toastr::success('Post Successfully Create');
		return redirect()->back();
	}


	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$post = Post::findOrFail($id);
		$category = Category::all();
		$tag = Tag::all();
		return view('admin.post.show', compact('post', 'category', 'tag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$post = Post::findOrFail($id);
		$category = Category::all();
		$tag = Tag::all();
		return view('admin.post.edit', compact('post', 'category', 'tag'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'title'				=> 'required',
			'image'				=> 'mimes:jpg,jpeg,png|max:3072',
			'categories'		=> 'required',
			'tags'					=> 'required',
			'body'				=> 'required',
		]);

		$post = Post::findOrFail($id);
		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->title);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check post dir is exists
			if (!Storage::disk('public')->exists('post')) {
				Storage::disk('public')->makeDirectory('post');
			}

			// old image delete with update
			if (Storage::disk('public')->exists('post/' . $post->image)) {
				Storage::disk('public')->delete('post/' . $post->image);
			}

			// resize image for post add upload
			$setImage = Image::make($image)->resize(1600, 1066)->stream();
			Storage::disk('public')->put('post/' . $imageName, $setImage);

			// check post thumbnail dir is exists
			if (!Storage::disk('public')->exists('post/thumbnail')) {
				Storage::disk('public')->makeDirectory('post/thumbnail');
			}

			// old image delete with update
			if (Storage::disk('public')->exists('post/thumbnail/' . $post->image)) {
				Storage::disk('public')->delete('post/thumbnail/' . $post->image);
			}

			// resize image thumbnail for post add upload
			$setImageThumbnail = Image::make($image)->resize(560, 360)->stream();
			Storage::disk('public')->put('post/thumbnail/' . $imageName, $setImageThumbnail);
		} else {
			// with out upload image
			$imageName = $post->image;
		}

		$post->user_id	= Auth::id();
		$post->title		= $request->title;
		$post->slug			= $slug;
		$post->image		= $imageName;
		$post->body			= $request->body;

		if (isset($request->status)) {
			$post->status	= 'active';
		} else {
			$post->status	= 'inactive';
		}

		$post->is_approved = 'true';
		$post->save();

		$post->category()->sync($request->categories);
		$post->tag()->sync($request->tags);


		Toastr::success('Post Successfully Update');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$post = Post::findOrFail($id);

		// image delete with storage
		if (Storage::disk('public')->exists('post/' . $post->image)) {
			Storage::disk('public')->delete('post/' . $post->image);
		}
		// image delete with storage
		if (Storage::disk('public')->exists('post/thumbnail/' . $post->image)) {
			Storage::disk('public')->delete('post/thumbnail/' . $post->image);
		}

		$post->category()->detach();
		$post->tag()->detach();
		$post->delete();
		Toastr::success('Post Successfully Delete');
		return redirect()->back();
	}


	/**
	 * Active update the specified resource in storage.
	 */
	public function active(String $id)
	{
		$status = Post::findOrFail($id);
		$status->status = 'inactive';
		$status->update();

		Toastr::success('Status Successfully Inactive');
		return redirect()->back();
	}

	/**
	 * Inactive update the specified resource in storage.
	 */
	public function inactive(string $id)
	{
		$status = Post::findOrFail($id);
		$status->status = 'active';
		$status->update();

		Toastr::success('Status Successfully Active');
		return redirect()->back();
	}

	/**
	 * Approved update the specified resource in storage.
	 */
	public function approved(string $id)
	{
		$approved = Post::findOrFail($id);
		$approved->is_approved = 'true';
		$approved->update();

		// Author SMTP mail server
		
		Toastr::success('Post Successfully Approved');
		return redirect()->back();
	}

	/**
	 * Pendding post the specified resource in storage.
	 */
	public function pendding()
	{
		$post = Post::where('status', 'inactive')->latest()->get();
		return view('admin.post.pendding', compact('post'));
	}
}

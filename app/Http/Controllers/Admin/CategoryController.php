<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$category = Category::latest()->get();
		return view('admin.category.index', compact('category'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.category.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'		=> 'required|unique:categories',
			'image' 	=> 'mimes:jpg,jpeg,png|max:3072',
		]);
		// return $request;


		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check category dir is exists
			if (!Storage::disk('public')->exists('category')) {
				Storage::disk('public')->makeDirectory('category');
			}
			// resize image for category add upload
			$setImage = Image::make($image)->resize(750, 500)->stream();
			Storage::disk('public')->put('category/' . $imageName, $setImage);
		} else {
			$imageName = 'default.png';
		}


		Category::create([
			'name'		=> $request->name,
			'slug' 		=> strtolower(Str::slug($request->name)),
			'image'		=> $imageName,
		]);

		Toastr::success('Category successfully add');
		return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id)
	{
		$category = Category::findOrFail($id);
		return view('admin.category.edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'name'		=> 'required',
			'image' 	=> 'mimes:jpg,jpeg,png|max:3072',
		]);

		$category = Category::findOrFail($id);

		// get form image
		$image = $request->file('image');
		$slug = Str::slug($request->name);
		if (isset($image)) {

			// make unique name for image
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			// check category dir is exists
			if (!Storage::disk('public')->exists('category')) {
				Storage::disk('public')->makeDirectory('category');
			}

			// old image delete with update
			if (Storage::disk('public')->exists('category/' . $category->image)) {
				Storage::disk('public')->delete('category/' . $category->image);
			}

			// resize image for category add upload
			$setImage = Image::make($image)->resize(750, 500)->stream();
			Storage::disk('public')->put('category/' . $imageName, $setImage);
		} else {
			// with out upload image
			$imageName = $category->image;
		}


		$category->update([
			'name'		=> $request->name,
			'slug' 		=> strtolower(Str::slug($request->name)),
			'image'		=> $imageName,
		]);

		Toastr::success('Category successfully update');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$category = Category::findOrFail($id);

		// image delete with storage
		if (Storage::disk('public')->exists('category/' . $category->image)) {
			Storage::disk('public')->delete('category/' . $category->image);
		}

		$category->delete();
		Toastr::success('Category successfully delete');
		return redirect()->back();
	}

	/**
	 * Active update the specified resource in storage.
	 */
	public function active($id)
	{
		$status = Category::findOrFail($id);
		$status->status = 'inactive';
		$status->update();
		Toastr::success('Tag successfully inactive');
		return redirect()->back();
	}


	/**
	 * Inactive update the specified resource in storage.
	 */
	public function inactive($id)
	{
		$status = Category::findOrFail($id);
		$status->status = 'active';
		$status->update();
		Toastr::success('Tag successfully active');
		return redirect()->back();
	}
}

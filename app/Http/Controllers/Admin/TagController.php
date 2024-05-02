<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$tag = Tag::latest()->get();
		return view('admin.tag.index', compact('tag'));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('admin.tag.create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|unique:tags',
		], [
			'name.required'		=> 'The tag name field is required.',
		]);

		// return $request;

		Tag::create([
			'name' => $request->name,
			'slug' => strtolower(Str::slug($request->name)),
		]); //object create with model name

		Toastr::success('Tag successfully add');
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
		$tag = Tag::findOrFail($id);
		return view('admin.tag.edit', compact('tag'));
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$this->validate($request, [
			'name' => 'required',
		], [
			'name.required'		=> 'The tag name field is required.',
		]);


		$tag = Tag::findOrFail($id);
		$tag->update([
			'name' => $request->name,
			'slug' => strtolower(Str::slug($request->name)),
		]); //object create with model name

		Toastr::success('Tag successfully update');
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		Tag::findOrFail($id)->delete();
		Toastr::success('Tag successfully delete');
		return redirect()->back();
	}


	/**
	 * Active update the specified resource in storage.
	 */
	public function active($id)
	{
		$tagStatus = Tag::findOrFail($id);
		$tagStatus->status = 'inactive';
		$tagStatus->update();
		Toastr::success('Tag successfully inactive');
		return redirect()->back();
	}


	/**
	 * Inactive update the specified resource in storage.
	 */
	public function inactive($id)
	{
		$tagStatus = Tag::findOrFail($id);
		$tagStatus->status = 'active';
		$tagStatus->update();
		Toastr::success('Tag successfully active');
		return redirect()->back();
	}
}

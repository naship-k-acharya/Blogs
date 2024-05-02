<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Cache\Store;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;


class ProfileController extends Controller
{
	public function index()
	{
		return view('admin.profile.index');
	}

	public function adminSetting()
	{
		return view('admin.profile.edit');
	}


	public function updateProfile(Request $request)
	{

		$this->validate($request, [
			'name'		=> 'required',
			'email'		=> 'required',
			'image'		=> 'mimes:jpg,jpeg,png,webp|max:3072'
		]);

		$user = User::findOrFail(Auth::user()->id);

		$image = $request->file('image');
		$slug = Str::slug($request->name);

		if (isset($image)) {
			$imageName = $slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

			if (!Storage::disk('public')->exists('profile')) {
				Storage::disk('public')->makeDirectory('profile');
			}

			if (Storage::disk('public')->exists('profile/' . $user->image)) {
				Storage::disk('public')->delete('profile/' . $user->image);
			}

			$setImage = Image::make($image)->resize(160, 160)->stream();
			Storage::disk('public')->put('profile/' . $imageName, $setImage);
		} else {
			$imageName = $user->image;
		}


		// $user->update([
		// 	'name' 	=> $request->name,
		// 	'email'	=> $request->email,
		// 	'image'	=> $imageName,
		// ]);

		$user->name 	= $request->name;
		$user->email	= $request->email;
		$user->image	= $imageName;
		$user->save();

		Toastr::success('Admin Profile Successfully Update');
		return redirect()->back();
	}


	public function updatePassword(Request $request)
	{
		$this->validate($request, [
			'old_password'		=> 'required',
			'password'		=> 'required|confirmed|min:8'
		]);

		$hashPassword = Auth::user()->password;
		
		if (Hash::check($request->old_password, $hashPassword)) {
			if (!Hash::check($request->password, $hashPassword)) {
				$user = User::findOrFail(Auth::user()->id);
				$user->password = Hash::make($request->password);
				$user->save();

				Toastr::success('Admin Password Successfully Change');
				return redirect()->back();
			} else {
				Toastr::error('New password connot be the same as old password');
				return redirect()->back();
			}
		} else {
			Toastr::error('Current password not match');
			return redirect()->back();
		}
	}
}

<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//user

Route::get('/user/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile.index');
Route::get('/user/profile/setting', [App\Http\Controllers\User\ProfileController::class, 'userSetting'])->name('user.profile.setting');
Route::put('/user/profile/setting/profile-update', [App\Http\Controllers\User\ProfileController::class, 'updateProfile'])->name('user.setting.update.profile');
Route::put('/user/profile/setting/password-update', [App\Http\Controllers\User\ProfileController::class, 'updatePassword'])->name('user.setting.update.password');





//HOME

Route::get('categories', [App\Http\Controllers\PostController::class, 'index'])->name('category');
Route::get('post/{slug}', [App\Http\Controllers\PostController::class, 'destails'])->name('post.destails');
Route::get('categories/{slug}', [App\Http\Controllers\PostController::class, 'postByCategory'])->name('category.post');
Route::get('tags/{slug}', [App\Http\Controllers\PostController::class, 'postByTag'])->name('tag.post');



Route::middleware(['auth'])->group(function () {
	Route::get('favorite/add/{post}', [App\Http\Controllers\FavoriteController::class, 'add'])->name('post.favorite');
	Route::get('favorite/remove/{post}', [\App\Http\Controllers\FavoriteController::class, 'add'])->name('favorite.remove');
	Route::post('comment/{post}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');
	Route::post('comment/{commentId}/reply', [\App\Http\Controllers\CommentController::class, 'reply'])->name('comment.reply');
	Route::get('/comment/{commentid}/add', [\App\Http\Controllers\CommentController::class, 'like'])->name('comment.like');
	Route::get('/comment/{commentid}/remove', [\App\Http\Controllers\CommentController::class, 'like'])->name('comment.remove');
	Route::post('subscriber', [App\Http\Controllers\SubscribeController::class, 'store'])->name('subscriber.store');

	Route::delete('/comments/delete/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.delete');

});




//ADMIN

// Admin Route Group
Route::group(['prefix' => 'admin'], function () {

	Route::controller(App\Http\Controllers\Admin\AdminController::class)->group(function () {
		Route::get('/dashboard', 'index')->name('admin.dashboard');
	}); // Admin Controller

	Route::controller(App\Http\Controllers\Admin\TagController::class)->group(function () {
		Route::get('/tag', 'index')->name('admin.tag.index');
		Route::get('/tag/create', 'create')->name('admin.tag.create');
		Route::post('/tag/store', 'store')->name('admin.tag.store');
		Route::get('/tag/edit/{id}', 'edit')->name('admin.tag.edit');
		Route::post('/tag/update/{id}', 'update')->name('admin.tag.update');
		Route::get('/tag/destroy/{id}', 'destroy')->name('admin.tag.destroy');
		Route::get('/tag/active/{id}', 'active')->name('admin.tag.active');
		Route::get('/tag/inactive/{id}', 'inactive')->name('admin.tag.inactive');
	}); // Tag Controller With Admin


	Route::controller(App\Http\Controllers\Admin\CategoryController::class)->group(function () {
		Route::get('/category', 'index')->name('admin.category.index');
		Route::get('/category/create', 'create')->name('admin.category.create');
		Route::post('/category/store', 'store')->name('admin.category.store');
		Route::get('/category/edit/{id}', 'edit')->name('admin.category.edit');
		Route::post('/category/update/{id}', 'update')->name('admin.category.update');
		Route::get('/category/destroy/{id}', 'destroy')->name('admin.category.destroy');
		Route::get('/category/active/{id}', 'active')->name('admin.category.active');
		Route::get('/category/inactive/{id}', 'inactive')->name('admin.category.inactive');
	}); // Category Controller With Admin


	Route::controller(App\Http\Controllers\Admin\PostController::class)->group(function () {
		Route::get('/post', 'index')->name('admin.post.index');
		Route::get('/post/create', 'create')->name('admin.post.create');
		Route::post('/post/store', 'store')->name('admin.post.store');
		Route::get('/post/edit/{id}', 'edit')->name('admin.post.edit');
		Route::post('/post/update/{id}', 'update')->name('admin.post.update');
		Route::get('/post/destroy/{id}', 'destroy')->name('admin.post.destroy');
		Route::get('/post/show/{id}', 'show')->name('admin.post.show');
		Route::get('/post/active/{id}', 'active')->name('admin.post.active');
		Route::get('/post/inactive/{id}', 'inactive')->name('admin.post.inactive');
		Route::get('/post/approved/{id}', 'approved')->name('admin.post.approved');
		Route::get('/pendding/post', 'pendding')->name('admin.post.pendding');
	}); // Post Controller With Admin


	//Favourite
	Route::get('favorite/posts', [App\Http\Controllers\Admin\FavoriteController::class, 'index'])->name('admin.favorite.index');
	

  //COmments
	Route::get('comment', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comment.index');
	Route::get('comment/destroy/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comment.destroy');
	


	//profile
	Route::get('profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile.index');
	Route::get('profile/setting', [App\Http\Controllers\Admin\ProfileController::class, 'adminSetting'])->name('admin.profile.setting');
	Route::put('profile/setting/profile-update', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('admin.setting.update.profile');
	Route::put('profile/setting/password-update', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.setting.update.password');

	// Subscriber Controller With Admin
	Route::get('subscriber', [App\Http\Controllers\Admin\SubscriberController::class, 'index'])->name('subscriber.index');
	Route::get('subscriber/destroy/{id}', [App\Http\Controllers\Admin\SubscriberController::class, 'destroy'])->name('subscriber.destroy');

});

  
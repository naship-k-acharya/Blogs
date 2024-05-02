<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
	use HasFactory;
	protected $guarded = [];


	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function category()
	{
		return $this->belongsToMany(Category::class)->withTimestamps();
	}

	public function tag()
	{
		return $this->belongsToMany(Tag::class)->withTimestamps();
	}

	public function favorite_users()
	{
		return $this->belongsToMany(User::class);
	}

	public function comments(): hasMany
	{
		return $this->hasMany(Comment::class);
	}

	public function scopeApproved($query)
	{
		return $query->where('is_approved', 'true');
	}

	public function scopeActive($query)
	{
		return $query->where('status', 'active');
	}
}

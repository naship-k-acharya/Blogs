<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id'); //changed this line
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('image')->default('default.png');
			$table->text('body');
			$table->integer('view_count')->default(0);
			$table->enum('status', ['active', 'inactive'])->default('inactive');
			$table->enum('is_approved', ['true', 'false'])->default('true');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('posts');
	}
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id'); // Без foreign key
			$table->string('title', 255);
			$table->text('content');
			$table->enum('status', ['draft', 'published', 'archived'])
				->default('published');
			$table->integer('views_count')->default(0);
			$table->integer('likes_count')->default(0);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

			$table->index('user_id');
			$table->index('created_at');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('posts');
	}
};
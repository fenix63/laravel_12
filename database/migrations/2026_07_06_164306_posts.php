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
		//Накатить миграцию (из под Windows):
		//php artisan migrate --path=\\database\\migrations\\2026_07_06_164306_posts.php
		//php artisan migrate --path=/database/migrations/2026_07_06_164306_posts.php  unix
		Schema::create('posts', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->string('title', 255);
			$table->text('content');
			$table->enum('status', ['draft', 'published', 'archived'])->default('published');
			$table->integer('views_count')->default(0);
			$table->integer('likes_count')->default(0);
			$table->timestamps();

			$table->index('user_id');
			$table->index('created_at');
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

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
		//php artisan migrate --path=\\database\\migrations\\2026_07_01_190012_create_comments_table.php
		//php artisan migrate --path=/database/migrations/2026_07_01_190012_create_comments_table.php  unix
		Schema::create('comments_optimized', function (Blueprint $table) {
			$table->id();
			$table->foreignId('post_id')
				->constrained('posts')
				->onDelete('cascade');
			$table->foreignId('user_id')
				->constrained('users')
				->onDelete('cascade');
			$table->foreignId('parent_id')
				->nullable()
				->constrained('comments_optimized')
				->onDelete('cascade');

			$table->text('content');

			// Строковое представление пути (пример: "00001.00003.00007.")
			$table->string('path', 255)->default('');

			// Глубина вложенности
			$table->integer('level')->default(0);

			$table->integer('likes_count')->default(0);

			$table->timestamps(); // created_at и updated_at

			// Индексы
			$table->index(['post_id', 'path'], 'idx_post_path');
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments_optimized');
    }
};

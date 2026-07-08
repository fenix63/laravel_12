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
			$table->foreignId('user_id')
				->constrained()
				->cascadeOnDelete()
				->cascadeOnUpdate();

			$table->string('title');
			$table->longText('content'); // longText для больших постов

			// Альтернатива enum через строку с проверкой в модели
			$table->string('status')
				->default('published')
				->index(); // Индекс для быстрой фильтрации по статусу

			$table->unsignedInteger('views_count')->default(0);
			$table->unsignedInteger('likes_count')->default(0);

			// Стандартные timestamps Laravel
			$table->timestamps(); // created_at и updated_at с правильными типами

			// Дополнительные индексы
			$table->index(['user_id', 'created_at']); // Составной индекс для частых запросов
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('posts');
	}
};
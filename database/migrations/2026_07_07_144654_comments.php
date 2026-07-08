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
		Schema::create('comments', function (Blueprint $table) {
			$table->id();

			// Внешние ключи
			$table->foreignId('post_id')
				->constrained()
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->foreignId('user_id')
				->constrained()
				->onDelete('cascade')
				->onUpdate('cascade');

			// Самоссылающийся внешний ключ для вложенности
			$table->foreignId('parent_id')
				->nullable()
				->constrained('comments')
				->onDelete('cascade')
				->onUpdate('cascade');

			$table->text('content');
			$table->integer('likes_count')->default(0);

			// Статус с помощью enum
			$table->enum('status', ['active', 'deleted', 'spam'])
				->default('active');

			// Timestamps
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

			// Индексы
			$table->index('post_id');
			$table->index('parent_id');
			$table->index('created_at');

			// Составной индекс для частых запросов
			$table->index(['post_id', 'created_at']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
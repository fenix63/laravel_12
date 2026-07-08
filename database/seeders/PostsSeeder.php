<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{
	public function run(): void
	{
		// Вариант 1: Создать 50 постов с автоматическим созданием пользователей
		Post::factory()
			->count(50)
			->create();

		// Вариант 2: Создать посты для конкретного пользователя
		$user = User::first() ?? User::factory()->create();

		Post::factory()
			->count(20)
			->for($user)
			->create();

		// Вариант 3: Создать посты с разными статусами
		Post::factory()
			->count(30)
			->published()
			->create();

		Post::factory()
			->count(10)
			->draft()
			->create();

		Post::factory()
			->count(5)
			->archived()
			->create();

		// Вариант 4: Создать популярные посты
		Post::factory()
			->count(5)
			->published()
			->popular()
			->create();

		// Вариант 5: Создать посты с конкретными данными
		Post::factory()
			->count(3)
			->state([
				'title' => 'Особенный пост с кастомным заголовком',
				'content' => 'Этот контент будет уникальным для каждого такого поста',
				'status' => Post::STATUS_PUBLISHED,
				'views_count' => 999,
			])
			->create();
	}
}
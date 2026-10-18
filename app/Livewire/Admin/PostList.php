<?php
// app/Livewire/Admin/PostList.php

namespace App\Livewire\Admin;

use App\Models\Post; // замените на свою модель
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
	use WithPagination;

	// Поиск и фильтры
	public string $search = '';
	public string $status = '';
	public string $dateRange = '';

	// Выбранные чекбоксы
	public array $selected = [];

	// Сброс страницы при изменении фильтров
	protected $queryString = [
		'search'   => ['except' => ''],
		'status'   => ['except' => ''],
		'dateRange'=> ['except' => ''],
	];

	public function updating($field)
	{
		// при изменении любого фильтра — на первую страницу
		if (in_array($field, ['search', 'status', 'dateRange'])) {
			$this->resetPage();
		}
	}

	public function resetFilters()
	{
		$this->reset(['search', 'status', 'dateRange']);
		$this->resetPage();
	}

	public function deleteSelected()
	{
		Post::whereIn('id', $this->selected)->delete();
		$this->selected = [];
		$this->dispatch('notify', message: 'Выбранные посты удалены');
	}

	private function searchByStatus(string $status)
	{
		$posts = Post::query()
			->when($status, fn ($q) => $q->where('status', $status))
			->latest()
			->paginate(10);

		return $posts;
	}

	public function render()
	{
		$posts = Post::query()
			->when($this->search, fn ($q) =>
			$q->where('title', 'like', "%{$this->search}%")
				->orWhere('author_name', 'like', "%{$this->search}%")
			)
			->when($this->status, fn ($q) => $q->where('status', $this->status))
			->when($this->dateRange, function ($q) {
				match ($this->dateRange) {
					'week'  => $q->where('created_at', '>=', now()->subWeek()),
					'month' => $q->where('created_at', '>=', now()->subMonth()),
					'year'  => $q->where('created_at', '>=', now()->subYear()),
					default => null,
				};
			})
			->latest()
			->paginate(10);

		return view('livewire.admin.post-list', compact('posts'));
	}
}
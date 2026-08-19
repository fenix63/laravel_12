<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\PostController;

class ModalComponent extends Component
{
	public bool $showModal = false;

	public $user_id = '';
	public $title = '';
	public $content = '';
	public $views_count = 0;
	public $likes_count = 0;

	public function render()
	{
		return view('livewire.modal-component');
	}

	public function savePost()
	{
		$data = [
			'user_id' => $this->user_id,
			'title' => $this->title,
			'content' => $this->content,
			'views_count' => $this->views_count,
			'likes_count' => $this->likes_count,
		];

		$postControllerObj = new PostController();
		$result = $postControllerObj->addPostFromForm($data);

		$this->closeModal();
		session()->flash('message', 'Пост успешно создан!');
	}

	public function openModal()
	{
		$this->showModal = true;
	}

	public function closeModal()
	{
		$this->showModal = false;
	}
}
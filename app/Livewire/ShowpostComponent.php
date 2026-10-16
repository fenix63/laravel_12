<?php

namespace App\Livewire;

use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\PostController;
use Livewire\Attributes\On;

class ShowpostComponent extends Component
{
	public bool $showModal = false;

	public $title;
	public $post_id;
	public $user_id;
	public $content;
	public $status;
	public $postData = [];


	public $statusList = [
		'draft' => 'Черновик',
		'published' => 'Опубликован',
		'archived' => 'В архиве'
	];

	public function render()
	{
		return view('livewire.showpost-component');
	}

	public function openModalShow()
	{
		$this->showModal = true;

		$this->postData = PostController::getPostDataByFilter(
			['id' => $this->post_id],
			['user_id', 'title', 'content', 'status']
		);


		//$this->post_id = $this->postData['result'][0]['post_id'];
		$this->user_id = $this->postData['result'][0]['user_id'];
		$this->title = $this->postData['result'][0]['title'];
		$this->content = $this->postData['result'][0]['content'];
		$this->status = $this->postData['result'][0]['status'];


		//$userId = $this->postData['result'][0]['user_id'];
		$this->postData['allUsers'] = UserController::getAllUsers(['id', 'name']);
		$index = array_search($this->user_id, array_column($this->postData['allUsers']['result'],'id'));
		$this->postData['result'][0]['user_name'] = $this->postData['allUsers']['result'][$index]['name'];

		$this->postData['statusList'] = Post::getPostStatusList();
		//$this->dispatch('modal-opened'); // Отправляем событие в браузер
	}

	public function closeModalShow()
	{
		$this->showModal = false;
		//$this->dispatch('modal-closed');
	}
}
<?php

namespace App\Livewire;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\PostController;
use App\Models\Post;

class EditPostComponent extends Component
{
	public bool $showModal = false;
	public $postData = [];
	public $post_id;
	public $statusList = [
		'draft'=>'Черновик',
		'published'=>'Опубликован',
		'archived'=>'В архиве'
	];
	public $postid;

	public function render()
	{
		return view('livewire.editpost-component');
	}

	public function openModal()
	{
		$this->showModal = true;

		$this->postData = PostController::getPostDataByFilter(
			['id' => $this->post_id],
			['user_id', 'title', 'content', 'status']
		);
		$userId = $this->postData['result'][0]['user_id'];
		$this->postData['allUsers'] = UserController::getAllUsers(['id', 'name']);
		$index = array_search($userId, array_column($this->postData['allUsers']['result'],'id'));
		$this->postData['result'][0]['user_name'] = $this->postData['allUsers']['result'][$index]['name'];

		$this->postData['statusList'] = Post::getPostStatusList();
		//$index = array_search($this->postData['result'][0]['status'],$this->postData['statusList']);
		//if($index!==false)
		//unset($this->postData['statusList'][$this->postData['result'][0]['status']]);

	}

	public function closeModal()
	{
		$this->showModal = false;
	}
}
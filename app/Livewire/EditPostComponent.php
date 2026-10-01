<?php

namespace App\Livewire;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Http\Controllers\MessageController;
use Mockery\Exception;

class EditPostComponent extends Component
{
	public bool $showModal = false;
	public $postData = [];

	public $title;
	public $post_id;
	public $user_id;
	public $content;
	public $status;



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

		MessageController::dbgLog($this->postData,'postDataFromDataBase');

		//$this->post_id = $this->postData['result'][0]['post_id'];
		$this->user_id = $this->postData['result'][0]['user_id'];
		$this->title = $this->postData['result'][0]['title'];
		$this->content = $this->postData['result'][0]['content'];
		//$this->status = $this->statusList[$this->postData['result'][0]['status']];
		$this->status = $this->postData['result'][0]['status'];


		/*MessageController::dbgLog(
			[
				'post_id' => $this->post_id,
				'title' => $this->title,
				'user_id' => $this->user_id,
				'content' => $this->content,
				'status' => $this->status
			],
			'_ControllerData'
		);*/

		//$userId = $this->postData['result'][0]['user_id'];
		$this->postData['allUsers'] = UserController::getAllUsers(['id', 'name']);
		$index = array_search($this->user_id, array_column($this->postData['allUsers']['result'],'id'));
		$this->postData['result'][0]['user_name'] = $this->postData['allUsers']['result'][$index]['name'];

		$this->postData['statusList'] = Post::getPostStatusList();
	}

	public function updatePost()
	{
		//Новые данные брать вот отсюла:
		//$this->postData['result'][0]['userId']
		//$this->postData['result'][0]['title']
		//$this->postData['result'][0]['content']
		//$this->postData['result'][0]['status']
		//$this->post_id

		try {
			$post = Post::find($this->post_id);
			$post->user_id = $this->user_id;
			$post->title = $this->title;
			$post->content = $this->content;
			$post->status = $this->status;
			$post->save();

		} catch (\Exception $e) {
			MessageController::dbgLog($e->getMessage(), '_catch');
		}

		$this->closeModal();
		session()->flash('message', 'Пост успешно создан!');
	}

	public function closeModal()
	{
		$this->showModal = false;
	}
}
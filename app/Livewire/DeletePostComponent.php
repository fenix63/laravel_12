<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class DeletePostComponent extends Component
{
	public bool $showModal = false;
	public $post_id;
    public function render()
    {
        return view('livewire.delete-post-component');
    }

	public function openModal()
	{
		$this->showModal = true;
	}

	public function deletePost()
	{
		$post = Post::find($this->post_id);
		$post->delete();

		$this->closeModal();
	}

	public function closeModal()
	{
		$this->showModal = false;
	}
}

<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class EditPostComponent extends Component
{
	public bool $showModal = false;

	public function render()
	{
		return view('livewire.editpost-component');
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
<?php

namespace App\Livewire;

use Livewire\Component;

class ModalComponent extends Component
{
	public bool $showModal = false;

	public function render()
	{
		return view('livewire.modal-component');
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
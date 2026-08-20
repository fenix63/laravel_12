<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Http\Controllers\PostController;
use Livewire\Attributes\On;

class ShowpostComponent extends Component
{
	public bool $showModal = false;


	public function render()
	{
		return view('livewire.showpost-component');
	}

	public function openModalPost()
	{
		$this->showModal = true;
		$this->dispatch('modal-opened'); // Отправляем событие в браузер
	}

	public function closeModal()
	{
		$this->showModal = false;
		$this->dispatch('modal-closed');
	}
}
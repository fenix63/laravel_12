<button class="btn-sm view" wire:click="openModalPost"><i class="fas fa-eye"></i> </button>


@if($showModal)
	<div class="showpost">
		Тут будут данные выбранного поста для просмотра
        <button wire:click="closeModal">Закрыть</button>
	</div>
@endif

<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('modal-opened', function () {
            // Опционально: показать модалку с анимацией
            console.log('Modal opened');
        });
    });
</script>
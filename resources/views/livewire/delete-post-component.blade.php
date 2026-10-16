<div>
    <button class="btn-sm delete" wire:click="openModal"><i class="fas fa-trash-alt"></i> </button>

    @if($showModal)
        <div class="modal-overlay" wire:keydown.escape.window="closeModal">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-header">
                        <button wire:click="closeModal" class="close-btn">&times;</button>
                    </div>
                    <div class="form-header">
                        <h1>Удаление поста</h1>
                    </div>

                    <form id="updatePostForm" method="POST" wire:submit.prevent="deletePost">
                        <header class="pm-header">
                            <h2 class="pm-title">Удалить пост № {{$post_id}} ?</h2>
                        </header>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                Отмена
                            </button>
                            <button type="submit" class="update btn btn-primary">
                                OK
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>

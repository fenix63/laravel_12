<div>
    <!-- Кнопка для открытия модального окна -->
    <button wire:click="openModal" class="btn btn-primary">
        <i class="fas fa-plus-circle"></i> Добавить пост
    </button>

    <!-- Модальное окно -->
    @if($showModal)
    <div class="modal-overlay" wire:click.self="closeModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Создание поста</h3>
                <button wire:click="closeModal" class="close-btn">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Содержимое модального окна -->
                <form>
                    <!-- ID пользователя с иконкой -->
                    <div class="form-group form-group-icon">
                        <label for="user_id">ID пользователя <span class="required">*</span></label>
                        <input
                                id="user_id"
                                name="user_id"
                                type="text"
                                class="form-control"
                                placeholder="Введите ID пользователя"
                        >
                        <span class="icon">👤</span>
                    </div>

                    <!-- Название поста -->
                    <div class="form-group form-group-icon">
                        <label for="title">Название поста <span class="required">*</span></label>
                        <input
                                id="title"
                                name="title"
                                type="text"
                                class="form-control"
                                placeholder="Придумайте заголовок"
                                value=""
                        >
                        <span class="icon">📌</span>
                    </div>

                    <!-- Текст поста -->
                    <div class="form-group form-group-icon textarea-icon">
                        <label for="content">Текст поста <span class="required">*</span></label>
                        <textarea
                                id="content"
                                name="content"
                                class="form-control"
                                placeholder="Напишите содержание поста..."
                        ></textarea>
                        <span class="icon" style="top: 16px; transform: none;">📄</span>
                    </div>

                    <!-- Два поля в ряд: просмотры и лайки -->
                    <div class="form-row">
                        <div class="form-group form-group-icon">
                            <label for="views_count">Просмотры</label>
                            <input
                                    id="views_count"
                                    name="views_count"
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    min="0"
                            >
                            <span class="icon">👁️</span>
                        </div>

                        <div class="form-group form-group-icon">
                            <label for="likes_count">Лайки</label>
                            <input
                                    id="likes_count"
                                    name="likes_count"
                                    type="number"
                                    class="form-control"
                                    placeholder="0"
                                    min="0"
                            >
                            <span class="icon">❤️</span>
                        </div>
                    </div>

                    <!-- Декоративная линия -->
                    <div class="form-divider"></div>

                    <!-- Кнопка отправки -->
                    <button type="submit" class="btn-submit">
                        ✨ Опубликовать пост
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <button wire:click="closeModal" class="btn btn-secondary">Отмена</button>
                <button class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
    @endif
</div>


<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        border-radius: 8px;
        padding: 20px;
        max-width: 900px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            transform: translateY(-30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #666;
    }

    .close-btn:hover {
        color: #333;
    }

    .modal-footer {
        border-top: 1px solid #ddd;
        padding-top: 15px;
        margin-top: 15px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
</style>
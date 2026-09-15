<div>
    <button wire:click="openModal" class="btn-sm edit">
        <i class="fas fa-edit"></i>
    </button>

    @if($showModal)
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-container">
                    <div class="modal-header">
                        <h3>Создание поста</h3>
                        <button wire:click="closeModal" class="close-btn">&times;</button>
                    </div>
                    <div class="form-header">
                        <h1>Обновление поста</h1>
                        <p>Заполните поля для обновления записи</p>
                    </div>

                    <form id="updatePostForm" method="POST" action="/posts/update">
                        <!-- ID пользователя -->
                        <div class="form-group">
                            <label for="userId">
                                ID пользователя<span class="required">*</span>
                            </label>
                            <input
                                    type="number"
                                    id="userId"
                                    name="userId"
                                    placeholder="Введите ID пользователя"
                                    min="1"
                                    required
                            >
                        </div>

                        <!-- Название -->
                        <div class="form-group">
                            <label for="title">
                                Название<span class="required">*</span>
                            </label>
                            <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    placeholder="Введите название поста"
                                    maxlength="255"
                                    required
                            >
                        </div>

                        <!-- Содержимое -->
                        <div class="form-group">
                            <label for="content">
                                Содержимое<span class="required">*</span>
                            </label>
                            <textarea
                                    id="content"
                                    name="content"
                                    placeholder="Введите содержимое поста..."
                                    rows="5"
                                    required
                            ></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" onclick="resetForm()">
                                Очистить
                            </button>
                            <button type="submit" class="update btn btn-primary">
                                Обновить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @endif

</div>

<script>
    // Обработчик отправки формы
    document.getElementById('updatePostForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = {
            userId: document.getElementById('userId').value,
            title: document.getElementById('title').value,
            content: document.getElementById('content').value
        };

        console.log('Отправка данных:', formData);

        // Здесь можно добавить fetch-запрос к API:
        /*
		fetch('/api/posts/update', {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(formData)
		})
		.then(res => res.json())
		.then(data => {
			alert('Пост успешно обновлён!');
		})
		.catch(err => {
			alert('Ошибка при обновлении поста');
			console.error(err);
		});
		*/
    });

    // Очистка формы
    function resetForm() {
        document.getElementById('updatePostForm').reset();
    }
</script>


<style>
    .form-container {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        padding: 40px;
        width: 100%;
        max-width: 500px;
    }

    .form-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .form-header h1 {
        font-size: 24px;
        color: #2d3748;
        margin-bottom: 8px;
    }

    .form-header p {
        color: #718096;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #2d3748;
        font-weight: 500;
        font-size: 14px;
    }

    .form-group label .required {
        color: #e53e3e;
        margin-left: 2px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-size: 15px;
        font-family: inherit;
        color: #2d3748;
        background: #f7fafc;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #667eea;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
        line-height: 1.5;
    }

    .form-group input::placeholder,
    .form-group textarea::placeholder {
        color: #a0aec0;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
    }

    .btn {
        flex: 1;
        padding: 13px 24px;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: inherit;
    }

    .update.btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .update.btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
    }

    .update.btn-primary:active {
        transform: translateY(0);
    }

    .update.btn-secondary {
        background: #edf2f7;
        color: #4a5568;
    }

    .update.btn-secondary:hover {
        background: #e2e8f0;
    }

    @media (max-width: 480px) {
        .form-container {
            padding: 24px;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>
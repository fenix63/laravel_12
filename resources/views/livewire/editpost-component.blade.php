<div>
    <button wire:click="openModal" class="btn-sm edit">
        <i class="fas fa-edit"></i>
    </button>



    @if($showModal)
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-body">
                    <div class="modal-header">
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
                            <?//TODO: Заменить на Select?>
                            <select name="userId" id="userId">
                                @foreach($postData['allUsers']['result'] as $userItem)
                                    @if($userItem['id']==$postData['result'][0]['user_id'])
                                        <option value="{{$userItem['id']}}" selected>{{$userItem['name']}}</option>
                                    @else
                                        <option value="{{$userItem['id']}}">{{$userItem['name']}}</option>
                                    @endif
                                @endforeach
                            </select>

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
                                    value="<?=$postData['result'][0]['title']?>"
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
                            ><?=$postData['result'][0]['content']?></textarea>
                        </div>

                        <!-- Статус (выпадающий список) -->
                        <div class="form-group">
                            <label for="status">
                                Статус<span class="required">*</span>
                            </label>
                            <select id="status" name="status" required>
                                <option value="" disabled>Выберите статус</option>
                                <option value="{{$postData['result'][0]['status']}}" selected>{{$postData['statusList'][$postData['result'][0]['status']]}}</option>


                                @foreach($postData['statusList'] as $key => $statusItem)
                                    @if($key!==$this->postData['result'][0]['status'])
                                        <option value="{{$key}}">{{$statusItem}}</option>
                                    @endif
                                @endforeach

                            </select>
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

    @endif

</div>




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

    .form-group select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url(data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23718096' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e);
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 18px;
        padding-right: 44px;
        cursor: pointer;

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
</style>
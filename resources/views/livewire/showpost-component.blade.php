<div>
    <button class="btn-sm view" wire:click="openModalShow"><i class="fas fa-eye"></i></button>


    @if($showModal)
    <div class="showpost" wire:keydown.escape.window="closeModalShow">


        <div class="pm-overlay">
            <div class="pm-backdrop" wire:click="close"></div>

            <div class="pm-dialog" role="dialog" aria-modal="true" wire:keydown.escape="closeModalShow">
                <div class="pm-accent"></div>

                <header class="pm-header">
                    <h2 class="pm-title">Просмотр поста</h2>
                    <button class="pm-close" wire:click="closeModalShow" aria-label="Закрыть">×</button>
                </header>

                <form action="">
                    <div class="form-group">
                        <label for="userId">
                            ID пользователя<span class="required">*</span>
                        </label>

                        <?//TODO: пользоваотелей надо получать динамически?>
                        <select name="user_id" wire:model="user_id" id="user_id" disabled>
                            @foreach($postData['allUsers']['result'] as $userItem)
                                @if($userItem['id']==$user_id)
                                    <option value="{{$userItem['id']}}" selected>{{$userItem['name']}}</option>
                                @else
                                    <option value="{{$userItem['id']}}">{{$userItem['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

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
                                wire:model="title"
                                disabled
                        >
                    </div>

                    <div class="form-group">
                        <label for="content">
                            Содержимое<span class="required">*</span>
                        </label>
                        <textarea
                                id="content"
                                name="content"
                                placeholder="Введите содержимое поста..."
                                rows="5"
                                disabled
                                wire:model="content"
                        >{{$content}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">
                            Статус<span class="required">*</span>
                        </label>
                        <select id="status" name="status" wire:model="status" disabled>
                            <option value="{{$status}}" selected>{{$statusList[$status]}}</option>


                            @foreach($postData['statusList'] as $key => $statusItem)
                                @if($key!==$status)
                                    <option value="{{$key}}">{{$statusItem}}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                </form>

                <footer class="pm-footer">
                    <button type="button" class="pm-btn pm-btn--ghost" wire:click="closeModalShow">Отмена</button>
                    <button type="submit" class="pm-btn pm-btn--primary">Сохранить</button>
                </footer>
            </div>
        </div>


        <button wire:click="close">Закрыть</button>
    </div>
    @endif
</div>


@assets
<style>

    .pm-overlay {
        position: fixed;
        inset: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        animation: pm-fade .25s ease-out;
    }

    .pm-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(15, 23, 42, .7);
        backdrop-filter: blur(4px);
    }

    .pm-dialog {
        position: relative;
        width: 100%;
        max-width: 640px;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, .25);
        overflow: hidden;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        animation: pm-pop .3s cubic-bezier(.16, 1, .3, 1);
    }

    .pm-accent {
        height: 6px;
        background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
    }

    .pm-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        background: linear-gradient(#fff, #f8fafc);
    }

    .pm-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }

    .pm-close {
        width: 36px;
        height: 36px;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: #94a3b8;
        font-size: 1.5rem;
        cursor: pointer;
        transition: all .2s;
    }

    .pm-close:hover {
        background: #f1f5f9;
        color: #334155;
        transform: rotate(90deg);
    }

    .pm-body {
        padding: 1.5rem;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .pm-footer {
        display: flex;
        justify-content: flex-end;
        gap: .75rem;
        padding: 1rem 1.5rem;
        border-top: 1px solid #f1f5f9;
        background: rgba(248, 250, 252, .8);
    }

    .pm-btn {
        padding: .625rem 1.125rem;
        border-radius: 12px;
        font-size: .875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all .2s;
        border: 1px solid transparent;
    }

    .pm-btn--ghost {
        background: #fff;
        border-color: #e2e8f0;
        color: #334155;
    }

    .pm-btn--ghost:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    .pm-btn--primary {
        background: linear-gradient(#6366f1, #4f46e5);
        color: #fff;
        box-shadow: 0 8px 16px -6px rgba(99, 102, 241, .6);
    }

    .pm-btn--primary:hover {
        box-shadow: 0 12px 20px -6px rgba(99, 102, 241, .7);
    }

    @keyframes pm-fade {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes pm-pop {
        from {
            opacity: 0;
            transform: translateY(24px) scale(.96);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

</style>
@endassets
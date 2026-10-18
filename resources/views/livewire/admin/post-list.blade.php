<div>
    <!-- ШАПКА -->
    <header class="admin-header">
        <h1>Управление постами</h1>
        <div class="header-actions">
            <button class="btn btn-outline" wire:click="export">
                <i class="fas fa-file-export"></i> Экспорт
            </button>
            <livewire:modal-component />
        </div>
    </header>

    <!-- ФИЛЬТРЫ -->
    <div class="filter-bar">
        <div class="search-wrap">
            <i class="fas fa-search"></i>
            <input type="text"
                   wire:model.live.debounce.400ms="search"
                   placeholder="Поиск по заголовку, автору...">
        </div>

        <div class="filter-select">
            <i class="fas fa-filter"></i>
            <select wire:model.live="status">
                <option value="">Все статусы</option>
                <option value="published">Опубликовано</option>
                <option value="draft">Черновик</option>
                <option value="archived">Архив</option>
            </select>
        </div>

        <div class="filter-select">
            <i class="far fa-calendar-alt"></i>
            <select wire:model.live="dateRange">
                <option value="">Все даты</option>
                <option value="week">За неделю</option>
                <option value="month">За месяц</option>
                <option value="year">За год</option>
            </select>
        </div>

        <div class="filter-actions">
            <button class="btn-icon" wire:click="resetFilters" title="Сбросить фильтры">
                <i class="fas fa-undo-alt"></i>
            </button>
            <button class="btn-icon" title="Настройки колонок">
                <i class="fas fa-sliders-h"></i>
            </button>
        </div>
    </div>

    <!-- ТАБЛИЦА -->
    <div class="posts-table-wrap">
        <table class="posts-table">
            <thead>
            <tr>
                <th class="checkbox-col">
                    <input type="checkbox" wire:model.live="selectAll">
                </th>
                <th>Заголовок / автор</th>
                <th>Статус</th>
                <th>Дата</th>
                <th style="text-align: right;">Действия</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $postItem)
            <tr wire:key="post-{{ $postItem->id }}" data-id="{{ $postItem->id }}">
                <td class="checkbox-col" data-label="Выбрать">
                    <input type="checkbox"
                           wire:model.live="selected"
                           value="{{ $postItem->id }}">
                </td>
                <td data-label="Заголовок">
                        <span class="post-title">
                            <a href="{{ route('posts.show', $postItem->id) }}" target="_blank">
                                {{ $postItem->title }} ({{ $postItem->id }})
                            </a>
                        </span>
                    <span class="post-meta">
                            <i class="far fa-user-circle"></i>
                            {{ $postItem->author_name ?? '—' }}
                        </span>
                </td>
                <td data-label="Статус">
                        <span class="status-badge {{ $postItem->status }}">
                            <i class="fas fa-circle" style="font-size: 0.4rem;"></i>
                            {{ $postItem->status }}
                        </span>
                </td>
                <td data-label="Дата">
                    {{ $postItem->created_at?->format('d.m.Y H:i') }}
                </td>
                <td data-label="Действия" style="text-align: right;">
                    <div class="actions-cell" style="justify-content: flex-end;">
                        <livewire:showpost-component
                                :post_id="$postItem->id"
                                :key="'show-'.$postItem->id" />
                        <livewire:editpost-component
                                :post_id="$postItem->id"
                                :key="'edit-'.$postItem->id" />
                        <livewire:delete-post-component
                                :post_id="$postItem->id"
                                :key="'del-'.$postItem->id" />
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding: 40px;">
                    Постов не найдено
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>

        <!-- ПАГИНАЦИЯ -->
        <div class="pagination-bar">
            <div class="pagination-info">
                <span class="fw-500">
                    {{ $posts->firstItem() ?? 0 }}–{{ $posts->lastItem() ?? 0 }}
                </span>
                из <span class="fw-500">{{ $posts->total() }}</span> постов
            </div>
            <div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
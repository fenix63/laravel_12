<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.5">
    <title>Админ-панель · Управление постами</title>
    <!-- Font Awesome 6 (Free) для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* ----- Обнуление и базовые стили ----- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: #f4f6fa;
            color: #1e293b;
            padding: 24px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
        }

        .admin-wrapper {
            max-width: 1440px;
            width: 100%;
        }

        /* ----- Шапка страницы ----- */
        .admin-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            gap: 16px 12px;
        }

        .admin-header h1 {
            font-weight: 600;
            font-size: 1.9rem;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .admin-header h1 i {
            color: #4f46e5;
            font-size: 2rem;
        }

        .header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 40px;
            font-weight: 500;
            font-size: 0.95rem;
            border: none;
            background: white;
            color: #1e293b;
            box-shadow: 0 2px 6px rgba(0,0,0,0.04);
            transition: 0.2s;
            cursor: pointer;
            text-decoration: none;
            border: 1px solid #e2e8f0;
        }

        .btn-primary {
            background: #4f46e5;
            color: white;
            border: 1px solid #4f46e5;
            box-shadow: 0 4px 8px rgba(79, 70, 229, 0.2);
        }

        .btn-primary:hover {
            background: #4338ca;
            transform: translateY(-1px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.25);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d0d5dd;
        }

        .btn-outline:hover {
            background: #f1f5f9;
            border-color: #b0b8c4;
        }

        .btn-danger {
            color: #b91c1c;
            border-color: #fecaca;
            background: #fef2f2;
        }

        .btn-danger:hover {
            background: #fee2e2;
            border-color: #f87171;
        }

        /* ----- Панель фильтров / поиска ----- */
        .filter-bar {
            background: white;
            border-radius: 28px;
            padding: 16px 24px;
            margin-bottom: 28px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #edf2f7;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 16px 20px;
        }

        .search-wrap {
            flex: 2 1 260px;
            display: flex;
            align-items: center;
            background: #f8fafc;
            border-radius: 60px;
            padding: 0 16px;
            border: 1px solid #e2e8f0;
            transition: 0.2s;
        }

        .search-wrap:focus-within {
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            background: white;
        }

        .search-wrap i {
            color: #94a3b8;
            font-size: 0.95rem;
        }

        .search-wrap input {
            border: none;
            background: transparent;
            padding: 12px 14px;
            font-size: 0.95rem;
            width: 100%;
            outline: none;
            color: #0f172a;
        }

        .filter-select {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f8fafc;
            padding: 0 12px 0 16px;
            border-radius: 60px;
            border: 1px solid #e2e8f0;
            height: 48px;
        }

        .filter-select i {
            color: #64748b;
        }

        .filter-select select {
            border: none;
            background: transparent;
            padding: 8px 4px 8px 0;
            font-size: 0.95rem;
            color: #0f172a;
            outline: none;
            cursor: pointer;
            font-weight: 450;
        }

        .filter-select select option {
            background: white;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            margin-left: auto;
        }

        .btn-icon {
            width: 48px;
            height: 48px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 60px;
            background: white;
            border: 1px solid #e2e8f0;
            color: #334155;
            transition: 0.15s;
            cursor: pointer;
        }

        .btn-icon:hover {
            background: #f1f5f9;
            border-color: #b9c2d0;
        }

        /* ----- Таблица постов (карточки на мобильных) ----- */
        .posts-table-wrap {
            background: white;
            border-radius: 28px;
            border: 1px solid #edf2f7;
            overflow-x: auto;
            box-shadow: 0 8px 24px rgba(0,0,0,0.02);
            padding: 4px 0;
        }

        .posts-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.95rem;
            min-width: 760px;
        }

        .posts-table th {
            text-align: left;
            padding: 18px 16px;
            background: #fafcff;
            color: #475569;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom: 1px solid #e9edf3;
        }

        .posts-table td {
            padding: 16px;
            border-bottom: 1px solid #f0f4fa;
            vertical-align: middle;
        }

        .posts-table tr:last-child td {
            border-bottom: none;
        }

        .posts-table tr:hover td {
            background: #fafcff;
        }

        /* статусы */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px 4px 10px;
            border-radius: 60px;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.01em;
        }

        .status-badge.published {
            background: #dcfce7;
            color: #166534;
        }

        .status-badge.draft {
            background: #f1f5f9;
            color: #334155;
        }

        .status-badge.archived {
            background: #fee2e2;
            color: #991b1b;
        }

        .post-title {
            font-weight: 500;
            color: #0f172a;
        }

        .post-meta {
            font-size: 0.8rem;
            color: #64748b;
            display: block;
            margin-top: 4px;
        }

        .actions-cell {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8rem;
            border-radius: 30px;
            border: 1px solid transparent;
            background: #f1f5f9;
            color: #1e293b;
            transition: 0.15s;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-sm i {
            font-size: 0.7rem;
        }

        .btn-sm.edit {
            background: #eef2ff;
            color: #4338ca;
        }
        .btn-sm.edit:hover {
            background: #d9e2ff;
        }

        .btn-sm.delete {
            background: #fef2f2;
            color: #b91c1c;
        }
        .btn-sm.delete:hover {
            background: #fecaca;
        }

        .btn-sm.view {
            background: #f1f5f9;
        }
        .btn-sm.view:hover {
            background: #e2e8f0;
        }

        .checkbox-col {
            width: 44px;
            text-align: center;
        }

        .checkbox-col input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: #4f46e5;
            cursor: pointer;
        }

        /* пагинация */
        .pagination-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px 14px 20px;
            border-top: 1px solid #edf2f7;
            background: #fafcff;
            border-radius: 0 0 28px 28px;
            gap: 12px;
        }

        .pagination-info {
            color: #475569;
            font-size: 0.9rem;
        }

        .pagination-buttons {
            display: flex;
            gap: 6px;
        }

        .page-btn {
            width: 40px;
            height: 40px;
            border-radius: 40px;
            border: 1px solid #e2e8f0;
            background: white;
            font-weight: 500;
            color: #1e293b;
            transition: 0.15s;
            cursor: pointer;
        }

        .page-btn.active {
            background: #4f46e5;
            border-color: #4f46e5;
            color: white;
        }

        .page-btn:hover:not(.active) {
            background: #f1f5f9;
        }

        /* Адаптив: карточки вместо таблицы на маленьких экранах */
        @media (max-width: 720px) {
            body { padding: 16px; }

            .filter-bar {
                padding: 16px;
                border-radius: 24px;
                flex-direction: column;
                align-items: stretch;
            }

            .filter-actions {
                margin-left: 0;
                justify-content: flex-end;
            }

            .posts-table-wrap {
                border-radius: 20px;
                padding: 0;
                background: transparent;
                border: none;
                box-shadow: none;
            }

            .posts-table {
                min-width: unset;
                border-collapse: separate;
                border-spacing: 0 16px;
            }

            .posts-table thead {
                display: none;
            }

            .posts-table tbody tr {
                display: block;
                background: white;
                border-radius: 24px;
                padding: 18px 16px 14px;
                border: 1px solid #edf2f7;
                box-shadow: 0 4px 12px rgba(0,0,0,0.02);
                margin-bottom: 12px;
            }

            .posts-table td {
                display: flex;
                align-items: center;
                padding: 8px 0;
                border: none;
                gap: 8px 12px;
                flex-wrap: wrap;
            }

            .posts-table td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #475569;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.02em;
                min-width: 80px;
            }

            .checkbox-col {
                display: none;
            }

            .actions-cell {
                margin-top: 4px;
                justify-content: flex-start;
                width: 100%;
            }

            .actions-cell::before {
                content: "Действия";
                font-weight: 600;
                color: #475569;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.02em;
                min-width: 80px;
            }

            .status-badge {
                font-size: 0.75rem;
            }

            .pagination-bar {
                flex-direction: column;
                align-items: center;
                background: transparent;
                border: none;
                padding: 16px 0 0;
            }
        }

        /* мелкие доработки */
        .text-muted { color: #64748b; }
        .fw-500 { font-weight: 500; }
        .gap-2 { gap: 8px; }
        .mt-2 { margin-top: 6px; }

        i.fa-regular, i.fas, i.far { pointer-events: none; }
    </style>
</head>
<body>
<div class="admin-wrapper">

    <!-- ШАПКА -->
    <header class="admin-header">
        <h1>
            <i class="fas fa-pen-fancy"></i>
            Управление постами
        </h1>
        <div class="header-actions">
            <button class="btn btn-outline"><i class="fas fa-file-export"></i> Экспорт</button>
            <button class="btn btn-primary"><i class="fas fa-plus-circle"></i> Создать пост</button>
        </div>
    </header>

    <!-- ФИЛЬТРЫ + ПОИСК -->
    <div class="filter-bar">
        <div class="search-wrap">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Поиск по заголовку, автору..." value="дизайн">
        </div>

        <div class="filter-select">
            <i class="fas fa-filter"></i>
            <select>
                <option value="">Все статусы</option>
                <option value="published" selected>Опубликовано</option>
                <option value="draft">Черновик</option>
                <option value="archived">Архив</option>
            </select>
        </div>

        <div class="filter-select">
            <i class="far fa-calendar-alt"></i>
            <select>
                <option value="">Все даты</option>
                <option value="week">За неделю</option>
                <option value="month">За месяц</option>
                <option value="year">За год</option>
            </select>
        </div>

        <div class="filter-actions">
            <button class="btn-icon" title="Сбросить фильтры"><i class="fas fa-undo-alt"></i></button>
            <button class="btn-icon" title="Настройки колонок"><i class="fas fa-sliders-h"></i></button>
        </div>
    </div>

    <!-- ТАБЛИЦА ПОСТОВ -->
    <div class="posts-table-wrap">
        <table class="posts-table">
            <thead>
            <tr>
                <th class="checkbox-col"><input type="checkbox" aria-label="Выбрать все"></th>
                <th>Заголовок / автор</th>
                <th>Статус</th>
                <th>Дата</th>
                <th style="text-align: right;">Действия</th>
            </tr>
            </thead>
            <tbody>
            <!-- Пост 1 -->
            <?
                foreach($data['result'] as &$postItem){
					$createdAt = new DateTime($postItem['created_at']);
					$postItem['created_at_formatted'] = $createdAt->format('d.m.Y');
                }
            ?>

            @foreach($data['result'] as $postItem){
                <tr>
                    <td class="checkbox-col" data-label="Выбрать"><input type="checkbox"></td>
                    <td data-label="Заголовок">
                        <span class="post-title">{{$postItem['title']}}</span>
                        <span class="post-meta"><i class="far fa-user-circle"></i> Анна Ковальчук · 5 мин чтения</span>
                    </td>
                    <td data-label="Статус"><span class="status-badge published"><i class="fas fa-circle" style="font-size: 0.4rem;"></i>{{$postItem['status']}}</span></td>
                    <td data-label="Дата">{{$postItem['created_at_formatted']}}</td>
                    <td data-label="Действия" style="text-align: right;">
                        <div class="actions-cell" style="justify-content: flex-end;">
                            <button class="btn-sm view"><i class="fas fa-eye"></i> </button>
                            <button class="btn-sm edit"><i class="fas fa-edit"></i> </button>
                            <button class="btn-sm delete"><i class="fas fa-trash-alt"></i> </button>
                        </div>
                    </td>
                </tr>
            }
            @endforeach



            </tbody>
        </table>

        <!-- ПАГИНАЦИЯ -->
        <div class="pagination-bar">
            <div class="pagination-info">
                <span class="fw-500">1–5</span> из <span class="fw-500">24</span> постов
            </div>
            <div class="pagination-buttons">
                <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn">4</button>
                <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <!-- небольшая дополнительная информация -->
    <div style="margin-top: 24px; display: flex; justify-content: flex-end; gap: 12px; font-size: 0.9rem; color: #475569; flex-wrap: wrap;">
        <span><i class="far fa-check-circle" style="color: #16a34a;"></i> 3 опубликовано</span>
        <span><i class="far fa-file-alt" style="color: #64748b;"></i> 2 черновика</span>
        <span><i class="far fa-archive" style="color: #b91c1c;"></i> 1 архив</span>
    </div>
</div>
</body>
</html>
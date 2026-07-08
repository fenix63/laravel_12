{{--
Расширяем базовый шаблон, который лежит в resources/views/layouts/app.blade.php
--}}
@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(145deg, #f8faff 0%, #eef2f9 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 1rem;
    }

    .post-container {
        max-width: 820px;
        width: 100%;
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 48px;
        padding: 2rem 2rem 1.5rem;
        box-shadow:
                0 30px 60px -20px rgba(0, 20, 40, 0.25),
                inset 0 1px 2px rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: all 0.2s ease;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 2rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid rgba(0, 0, 0, 0.04);
    }

    .post-header h1 {
        font-size: 1.9rem;
        font-weight: 600;
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, #1e293b, #334155);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .post-header h1 i {
        color: #3b82f6;
        font-size: 1.8rem;
        background: rgba(59, 130, 246, 0.12);
        padding: 6px 10px;
        border-radius: 40px;
    }

    .post-count {
        font-size: 0.9rem;
        background: rgba(0, 0, 0, 0.04);
        padding: 6px 16px;
        border-radius: 60px;
        color: #475569;
        font-weight: 500;
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Сетка постов */
    .post-list {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    /* Карточка поста */
    .post-item {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        border-radius: 28px;
        padding: 1.5rem 1.8rem;
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 8px 20px -8px rgba(0, 20, 40, 0.08);
        transition: all 0.25s ease;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        gap: 1rem 1.5rem;
        cursor: default;
    }

    .post-item:hover {
        transform: translateY(-4px) scale(1.01);
        background: rgba(255, 255, 255, 0.85);
        box-shadow: 0 20px 35px -12px rgba(0, 20, 40, 0.18);
        border-color: rgba(255, 255, 255, 0.95);
    }

    /* Аватар / иконка */
    .post-avatar {
        flex-shrink: 0;
        width: 56px;
        height: 56px;
        background: linear-gradient(145deg, #dbeafe, #bfdbfe);
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1e4a8a;
        font-size: 1.6rem;
        font-weight: 500;
        box-shadow: 0 6px 12px -6px rgba(0, 0, 0, 0.08);
        border: 2px solid rgba(255, 255, 255, 0.6);
    }

    /* Контент поста */
    .post-content {
        flex: 1;
        min-width: 180px;
    }

    .post-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #0f172a;
        letter-spacing: -0.01em;
        line-height: 1.4;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .post-title .badge {
        font-size: 0.65rem;
        font-weight: 600;
        background: #e2e8f0;
        color: #334155;
        padding: 2px 12px;
        border-radius: 40px;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        background: rgba(59, 130, 246, 0.08);
        color: #2563eb;
        border: 1px solid rgba(59, 130, 246, 0.15);
    }

    .post-excerpt {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #334155;
        margin-bottom: 12px;
        opacity: 0.85;
    }

    .post-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 14px 20px;
        font-size: 0.8rem;
        color: #64748b;
    }

    .post-meta i {
        margin-right: 5px;
        color: #94a3b8;
        font-size: 0.75rem;
    }

    .post-meta .date {
        background: rgba(0, 0, 0, 0.02);
        padding: 2px 12px;
        border-radius: 40px;
        border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 4px;
    }

    .post-tags span {
        background: rgba(0, 0, 0, 0.02);
        padding: 2px 12px;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 500;
        color: #475569;
        border: 1px solid rgba(0, 0, 0, 0.03);
        backdrop-filter: blur(2px);
        letter-spacing: 0.2px;
    }

    .post-tags span i {
        margin-right: 4px;
        font-size: 0.6rem;
        color: #94a3b8;
    }

    /* Кнопка действия (как лайк/коммент) */
    .post-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-left: auto;
        flex-shrink: 0;
        align-self: center;
    }

    .post-actions button {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 0.9rem;
        padding: 6px 12px;
        border-radius: 40px;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: 0.15s;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(2px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        font-weight: 500;
    }

    .post-actions button i {
        font-size: 0.9rem;
    }

    .post-actions button:hover {
        background: rgba(59, 130, 246, 0.08);
        color: #2563eb;
        border-color: rgba(59, 130, 246, 0.1);
        transform: scale(1.02);
    }

    .post-actions button.liked {
        color: #ef4444;
    }

    /* футер */
    .post-footer {
        margin-top: 2rem;
        text-align: center;
        color: #94a3b8;
        font-size: 0.8rem;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
        padding-top: 1.25rem;
        letter-spacing: 0.3px;
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .post-footer i {
        margin: 0 4px;
    }

    /* Адаптив */
    @media (max-width: 600px) {
        .post-container {
            padding: 1.5rem 1rem;
            border-radius: 32px;
        }
        .post-item {
            flex-direction: column;
            padding: 1.25rem;
            gap: 0.6rem;
        }
        .post-avatar {
            width: 44px;
            height: 44px;
            font-size: 1.2rem;
        }
        .post-title {
            font-size: 1.1rem;
        }
        .post-actions {
            margin-left: 0;
            align-self: flex-start;
            width: 100%;
            justify-content: flex-start;
            margin-top: 6px;
        }
        .post-header {
            flex-direction: column;
            gap: 8px;
            align-items: flex-start;
        }
    }

    /* анимация при загрузке */
    .post-item {
        opacity: 0;
        animation: fadeUp 0.5s ease forwards;
    }
    .post-item:nth-child(1) { animation-delay: 0.02s; }
    .post-item:nth-child(2) { animation-delay: 0.07s; }
    .post-item:nth-child(3) { animation-delay: 0.12s; }
    .post-item:nth-child(4) { animation-delay: 0.17s; }
    .post-item:nth-child(5) { animation-delay: 0.22s; }

    @keyframes fadeUp {
        0% { opacity: 0; transform: translateY(16px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="post-container">
    <!-- Заголовок -->
    <div class="post-header">
        <h1>
            <i class="fas fa-pen-fancy"></i>
            Лента идей
        </h1>
        <span class="post-count"><i class="far fa-file-alt"></i> 5 постов</span>
    </div>

    <!-- Список постов -->
    <div class="post-list">
        @foreach($posts as $post)
            <div class="post-item">
                <div class="post-avatar">🧠</div>
                <div class="post-content">
                    <div class="post-title">
                        {{$post['title']}}
                        <span class="badge"><i class="far fa-star"></i> топ</span>
                    </div>
                    <div class="post-excerpt">
                        {{$post['content']}}
                    </div>
                    <div class="post-meta">
                        <span><i class="far fa-calendar-alt"></i>{{$post['created_at']}}</span>
                        <span><i class="far fa-clock"></i> 6 мин чтения</span>
                        <span class="post-tags">
                            <span><i class="fas fa-tag"></i> мышление</span>
                            <span><i class="fas fa-tag"></i> саморазвитие</span>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
</div>


@endsection

@push('styles')
<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush



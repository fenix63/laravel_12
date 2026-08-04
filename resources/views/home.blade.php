{{--
Расширяем базовый шаблон, который лежит в resources/views/layouts/app.blade.php
--}}
@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')




<div class="post-container">
    <!-- Заголовок -->
    <div class="post-header">
        <h1 class="test">
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



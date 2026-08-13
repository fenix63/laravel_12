{{--
Расширяем базовый шаблон, который лежит в resources/views/layouts/app.blade.php
--}}

@if(empty($postdata['result']))
    abort(404);
@endif


@extends('layouts.app')



@section('title', 'Детальная страница поста')


<?php


?>

<div class="post-detail">

    <!-- Навигация назад -->
    <a href="/posts/" class="back-nav">
        <i class="fas fa-arrow-left"></i> Назад к списку
    </a>



    <!-- Заголовок -->
    <h1 class="post-title">{{$postdata['result']['title']}}</h1>





    <!-- Текст поста -->
    <div class="post-body">
        {{$postdata['result']['content']}}

        <div class="comments-block">
            <div class="comment-section-title">
                <h3>Комментарии</h3>
                <span class="comment-count">{{count($comments['result'])}}</span>
            </div>
            <div class="comment-list">

                @foreach($comments['result'] as $comment)
                    @if(empty($comment['parent_id']))
                        <div class="comment-wrap">
                            <div class="comment-item">
                                <div class="comment-header">
                                    <span class="comment-id">#id: {{$comment['id']}}</span>
                                </div>
                                <div class="comment-content">
                                    {{$comment['content']}}
                                </div>

                                <div class="comment-footer">
                                    <div class="likes">
                                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"></path>
                                            <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                                        </svg>
                                        <span class="likes-count">{{$comment['likes_count']}}</span>
                                    </div>
                                </div>
                            </div>

                            @foreach($comments['result'] as $commentItem)
                                @if($commentItem['parent_id']==$comment['id'])
                                    <div class="comment-child">
                                        <div class="comment-item">
                                            <div class="comment-header">
                                                <span class="comment-id">#id: {{$commentItem['id']}}</span>
                                            </div>
                                            <div class="comment-content">
                                                {{$commentItem['content']}}
                                            </div>
                                            <div class="comment-footer">
                                                <div class="likes">
                                                    <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"></path>
                                                        <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                                                    </svg>
                                                    <span class="likes-count">{{$commentItem['likes_count']}}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endforeach



            </div><!--commments list-->
        </div>
    </div>



</div>

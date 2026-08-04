{{--
Расширяем базовый шаблон, который лежит в resources/views/layouts/app.blade.php
--}}

@if(empty($postdata['result']))
    abort(404);
@endif


@extends('layouts.app')



@section('title', 'Детальная страница поста')

<?php
/*
@section('content')
	<div>Детальная страница поста</div>


        @foreach($postdata['result'] as $key => $value)
            <div>{{$key}}:{{$value}}</div>
        @endforeach

@endsection
*/

//echo '<pre>';
//print_r($postdata['result']);
//echo '</pre>';
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
    </div>

    <div class="reactions-bar">
        <div class="reactions-left">
            <button class="liked"><i class="fas fa-heart"></i>{{$postdata['result']['likes_count']}}</button>
            <button><i class="far fa-comment"></i>{{$postdata['result']['views_count']}}</button>
        </div>

    </div>

</div>

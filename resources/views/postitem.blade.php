{{--
Расширяем базовый шаблон, который лежит в resources/views/layouts/app.blade.php
--}}

@if(empty($postdata['result']))
    abort(404);
@endif


@extends('layouts.app')



@section('title', 'Детальная страница поста')

@section('content')
	<div>Детальная страница поста</div>


        @foreach($postdata['result'] as $key => $value)
            <div>{{$key}}:{{$value}}</div>
        @endforeach

@endsection
@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1>Список постов</h1>

	</div>

</div>
@endsection

@push('styles')
<style>
    .card {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush
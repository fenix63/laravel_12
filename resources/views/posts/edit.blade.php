<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Posts</title>
	@if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	@endif

	<link rel="stylesheet" href="custom.css" />
</head>
<body>
<form action="{{route('postupdate', $postItem->id)}}" method="post">
    @csrf
    <label for="title">
        Название
    </label>
    <input type="text" placeholder="Введите название" name="title" id="title" value="{{$postItem->title}}">

</form>

</body>
</html>
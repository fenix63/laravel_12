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
<div class="post-item">
	<h2>{{$postItem->title}}</h2>
    <p>{{$postItem->text}}</p>
    <a href="{{route('postedit', $postItem->id)}}">Редактировать</a>
</div>

</body>
</html>
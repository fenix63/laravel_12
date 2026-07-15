<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Ошибка 500: Внутренняя ошибка сервера</title>
	<style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
        }
        h1 { font-size: 5rem; margin: 0; color: #dc3545; }
        p { font-size: 1.5rem; }
        a { text-decoration: none; color: #007bff; border-bottom: 1px dashed; }
	</style>
</head>
<body>
<h1>500</h1>
<p>Ой! Что-то пошло не так на наших серверах.</p>
<a href="{{ url('/') }}">Вернуться на главную</a>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Имя">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Пароль">
    <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>

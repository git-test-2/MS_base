<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Восстановление пароля - MindSpace</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="email-container">
    <h2>Восстановление пароля</h2>
    <p>Здравствуйте!</p>
    <p>Ваш новый пароль для доступа к MindSpace:</p>

    <p style="font-size: 18px; font-weight: bold; color: #343a40;">{{ $password }}</p>

    <p>Рекомендуем изменить этот пароль после первого входа.</p>

    <a href="{{ route('login') }}" class="btn">Войти в аккаунт</a>

    <div class="footer">
        <p>С уважением,<br>Команда MindSpace</p>
    </div>
</div>
</body>
</html>



{{--Было на уроке оформление письма простое--}}
{{--<p>Новый пароль. C уважением MindSpace</p>--}}
{{--<p>Пароль: {{ $password }}</p>--}}


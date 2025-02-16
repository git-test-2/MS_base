<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login_process(LoginRequest $request)
    {
        // Получаем данные из валидированного реквеста
        $data = $request->validated(); // Метод validated() возвращает только валидированные данные.

        // метод ->attempt() будет пытаться сделать авторизацию,
        // передаём в него массив с данными. Пароль сам метод автоматически превратит в хеш.
        // авторизовывать будем по гварду - "admin"
        if (auth("admin")->attempt($data))
        {
            return redirect()->route('admin.quotes.index')->with('success', 'Вы успешно авторизировались!');
        }
        //  admin.quotes.index - куда будет попадать админ после авторизации

        //если не авторизировались, то перекинет на admin.login
        return redirect()->route('admin.login')->with('error', 'Вы НЕ авторизировались!');
    }

    public function logout()
    {
        auth("admin")->logout();

        return redirect()->route('admin.login');
    }

}

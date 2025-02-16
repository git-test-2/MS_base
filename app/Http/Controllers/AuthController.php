<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login_process(LoginRequest $request)
    {
        // Получаем данные из валидированного реквеста
        $data = $request->validated(); // Метод validated() возвращает только валидированные данные.

        // метод ->attempt() будет пытаться сделать авторизацию,
        // передаём в него массив с данными. Пароль сам метод автоматически превратит в хеш.
        if (auth("web")->attempt($data))
        {
            return redirect()->route('home')->with('success', 'Вы успешно авторизировались!');
        }

        //если не авторизировались, то перекинет на логин
        return redirect()->route('login')->with('error', 'Ошибка: пользователь не найден, либо данные введены неправильно.');

    }

    public function logout()
    {
        auth("web")->logout(); // ->logout() разлогинет из сессии текущего пользователя
        return redirect()->route('home')->with('success', 'Вы успешно разлогинились');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // RegisterRequest
    // в RegisterRequest указывать поле avatar не нужно, потому что аватар устанавливается автоматически при создании пользователя.
    // Валидация RegisterRequest проверяет только те поля, которые приходят от пользователя через форму регистрации.
    public function register_process(RegisterRequest $request)
    {
        // Получаем данные из валидированного реквеста
        $data = $request->validated(); // Метод validated() возвращает только валидированные данные.

        //создаём нового пользователя
        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => bcrypt($data["password"]), // Хешируем пароль
            'avatar' => 'images/default-avatar.png', // добавили стандартный аватар при регистрации (Теперь у каждого нового пользователя будет аватар по умолчанию)
        ]);

        //если всё хорошо, берём объект юзера и залогинем его. auth() - хелпер
        if($user)
        {
            //передаём гуард в auth(). (по умолчанию, если ничего не передадим будет 'guard' => 'web', config\auth.php)
            auth("web")->login($user); // ->login($user) логинем текущий объект юзера
        }

        return redirect()->route('home')->with('success', 'Вы успешно зарегистрированы!');
    }


    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    //ForgotPasswordRequest
    public function forgot_process(ForgotPasswordRequest $request)
    {
        $data = $request->validated();

        //найдём юзера, где его эмеил равен эмейлу с нашей формы
        $user = User::where(["email" => $data['email']])->first();

        $password = uniqid();

        $user->password = bcrypt($password); // устанавливаем юзеру новый пароль
        $user->save();  // сохраняем новый пароль

        // Укакзываем всего юзера, а Лара автоматически возьмёт поле от юзера
        Mail::to($user)->send(new ForgotPassword($password));
        //В to() мы можем передать модель с юзером, и Лара автоматически возьмёт у него поле эмеил если оно заполнено и
        //от правит этому юзеру. Или можем строкой указать на какой эмеил будем отправлять
        //$request->validated() - передаём все поля с нашей формы (только валидированные ->validated() )
        //можно указать от кого отправлено сообщение ->from()


        return redirect()->route('forgot')->with('success', 'Данные успешно отправлены!');
    }

}

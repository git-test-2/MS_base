<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Форма редактирования профиля
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]); //  передаёт этого пользователя в шаблон profile.edit
    }

    // Обновление данных пользователя
    // Почему в метод не передаётся сам пользователь (User $user)
    // Потому что Auth::user() уже даёт нам того самого пользователя, который авторизован.
    public function update(Request $request)
    {
        $user = Auth::user(); // Auth::user() – получает авторизованного пользователя (того, кто сейчас залогинен).
        //dd($user);

        //Пароль можно не заполнять (nullable) - confirmed – должен совпадать с password_confirmation (из формы).
        //Аватар можно не загружать (nullable)
        //Должно быть изображение (image).
        //Максимальный размер 2MB (max:2048).
        //Размер не больше 184x184 пикселя (dimensions:max_width=184,max_height=184).
        //Почта обязательна. Должна быть уникальной, но исключая текущего пользователя ($user->id).         !!!!!!!!!!!!
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=184,max_height=184'
        ]);

        //'unique:users,email,' . $user->id
        //✔️ Проверяет уникальность email среди всех пользователей в БД в таблице users.
        //✔️ Исключает из проверки пользователя с id = $user->id, чтобы он мог оставить свою же почту без ошибки.

        $user->name = $request->name; // Получаем новые данные из формы ($request->name, $request->email). Обновляем их у пользователя.
        $user->email = $request->email;

        //filled('password') – проверяет, ввёл ли пользователь новый пароль. (filled с англ. - заполненный)
        //Если пароль введён, то обновляем его, зашифровав (bcrypt).
        if($request->filled('password'))
        {
            $user->password = bcrypt($request->password);
        }

        //if ($request->hasFile('avatar')) – проверяем, загрузил ли пользователь новый аватар.
        //$user->avatar && $user->avatar !== 'images/default-avatar.png' – если у пользователя уже был аватар
        //(и он не стандартный), то удаляем его:
        //\Storage::disk('public')->delete($user->avatar); – удаляет старый файл из папки storage/app/public.
        if ($request->hasFile('avatar')) {
            // Удаляем старый аватар, если он не стандартный
            if ($user->avatar && $user->avatar !== 'images/default-avatar.png') {
                \Storage::disk('public')->delete($user->avatar);
            }

            // Загружаем новый аватар
            //$request->file('avatar') – получаем загруженный файл.
            // ->store('avatars', 'public') – сохраняем файл в папку storage/app/public/avatars.
            // 'avatars' - папка, 'public' - Это "диск" хранения, который указывает на storage/app/public
            // В config/filesystems.php определён диск 'public', который указывает на storage/app/public.
            //Laravel автоматически создаёт ссылку public/storage → storage/app/public, если выполнить команду: php artisan storage:link
            //$user->avatar = $path; – обновляем путь к файлу в БД.
            $path = $request->file('avatar')->store('avatars', 'public');
            //Laravel по умолчанию создаёт уникальные имена файлов при сохранении через store(), чтобы избежать конфликтов
            //метод — store('avatars', 'public') — делает несколько вещей:
            // Берёт файл из запроса ($request->file('avatar')).
            // Сохраняет его в указанную директорию (avatars) внутри указанного диска (public).
            // Генерирует уникальное имя файла и возвращает его                                                  !!!!!!!

            $user->avatar = $path;
        }

        $user->save(); // Сохранение пользователя

        return back()->with('success', 'Профиль успешно обновлён!');
    }

    // Удаление аккаунта
    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('home')->with('success', 'Ваш аккаунт был удалён.');

    }



}

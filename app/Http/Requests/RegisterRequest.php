<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        //unique:users,email - проверка на уникальность почты, поля "email" из таблицы "users"
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|string|unique:users,email|max:255', // Проверка на уникальность и ограничение длины
            'password' => 'required|string|min:8|confirmed', // Минимум 8 символов для безопасности
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Заполните поле имени.',
            'name.string'   => 'Имя должно быть строкой.',
            'name.min'      => 'Имя должно содержать не менее 3 символов.',
            'name.max'      => 'Имя не должно превышать 50 символов.',

            'email.required'  => 'Поле "Email" обязательно для заполнения.',
            'email.email'     => 'Введите корректный адрес электронной почты.',
            'email.string'    => 'Email должен быть строкой.',
            'email.unique'    => 'Такой адрес уже зарегистрирован.',
            'email.max'       => 'Email не должен превышать 255 символов.',

            'password.required'  => 'Поле "Пароль" обязательно для заполнения.',
            'password.string'    => 'Пароль должен быть строкой.',
            'password.min'       => 'Пароль должен содержать не менее 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
        ];
    }

}

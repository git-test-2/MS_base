<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return [
            'email' => 'required|email|string|max:255', // Проверка на уникальность и ограничение длины
            'password' => 'required|string|min:8', // Минимум 8 символов для безопасности
        ];
    }

    // exists:users, email. - проверка есть ли в БД почта. Но так лучше не делать, потому что будут перебирать почты.
    // чтобы выснить какие почты есть, каких нет, и дальше с ними работать. Это не безопасно.
    // users - таблица, email - поле в таблице

    public function messages()
    {
        return [
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.string' => 'Email должен быть строкой.',
            'email.max' => 'Email не должен превышать 255 символов.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
        ];
    }

}

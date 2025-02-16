<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
        // поле 'email' должнл быть в таблице exists:users
        return [
            'email' => 'required|email|exists:users',
        ];
    }
    
    public function messages()
    {
        return [
            'email.required' => 'Пожалуйста, укажите ваш email.',
            'email.email'    => 'Введите корректный адрес электронной почты.',
            'email.exists'   => 'Пользователь с таким email не найден.', // Новое сообщение для ошибки "не существует"
        ];
    }

}

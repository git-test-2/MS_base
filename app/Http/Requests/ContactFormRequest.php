<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //false
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'userMessage' => 'required|string|min:8|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Пожалуйста, укажите ваш email.',
            'email.email'    => 'Введите корректный адрес электронной почты.',

            'userMessage.required' => 'Поле "Сообщение" не может быть пустым.',
            'userMessage.string'   => 'Сообщение должно быть текстом.',
            'userMessage.min'      => 'Сообщение должно содержать не менее :min символов.',
            'userMessage.max'      => 'Сообщение не должно превышать :max символов.',
        ];
    }

}

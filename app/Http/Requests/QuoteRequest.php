<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quote'    => 'required|string|max:255', // Обязательное, не длиннее 255 символов
            'author'   => 'nullable|string|max:100', // Необязательное, строка, максимум 100 символов
            'year'     => 'nullable|integer|min:0|max:' . date('Y'), // Необязательное, целое число, от 0 до текущего года
            'source'   => 'nullable|string|max:150', // Необязательное, максимум 150 символов
            'category' => 'nullable|string|max:100', // Необязательное, максимум 100 символов
        ];
    }

    public function messages()
    {
        return [
            'quote.required'  => 'Заполните поле цитаты.',
            'quote.string'    => 'Цитата должна быть строкой.',
            'quote.max'       => 'Цитата не должна превышать 255 символов.',

            'author.string'   => 'Имя автора должно быть строкой.',
            'author.max'      => 'Имя автора не должно превышать 100 символов.',

            'year.integer'    => 'Год должен быть числом.',
            'year.min'        => 'Год не может быть отрицательным.',
            'year.max'        => 'Год не может быть больше текущего года.',

            'source.string'   => 'Источник должен быть строкой.',
            'source.max'      => 'Источник не должен превышать 150 символов.',

            'category.string' => 'Категория должна быть строкой.',
            'category.max'    => 'Категория не должна превышать 100 символов.',
        ];
    }

}

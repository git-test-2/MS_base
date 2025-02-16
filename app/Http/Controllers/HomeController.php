<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function quote()
    {
        return view('quote', [
            'quotes' => DB::table('quotes')->paginate(2)
        ]);
    }

    public function showContactForm()
    {
        return view('contact_form');
    }

    // не забыть указать что в ContactFormRequest минимум 8 символов в сообщении может быть и вывести ошибку, если не отправил письмо
    public function contactForm(ContactFormRequest $request)
    {
        //Если посмотрим отвалидированные данные  dd($request->validated());  то увидим только:
        //"email" => "you@mail.com" и "userMessage" => "12345678"
        //Поэтому в вид письма (resources\views\emails\contact_form.blade.php) мы пеередаём две переменные - $email и $userMessage
        //А не весь массив $formData как написано в app\Mail\ContactForm.php

        //В to() мы можем передать модель с юзером, и Лара автоматически возьмёт у него поле эмеил если оно заполнено и
        //от правит этому юзеру. Или можем строкой указать на какой эмеил будем отправлять
        //$request->validated() - передаём все поля с нашей формы (только валидированные ->validated() )
        //можно указать от кого отправлено сообщение ->from()
        Mail::to("no-reply@mindspace.test")->send(new ContactForm($request->validated()));

        return redirect()->route('contacts')->with('success', 'Ваше сообщение успешно отправлено!');
    }

}

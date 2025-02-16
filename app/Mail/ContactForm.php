<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    protected $formData = []; // наши данныее из формы. Указываем что массив = [].

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formData)
    {
        // cюда попадают любые переменные, которые мы будем отправлять в этот класс
        $this->formData = $formData; //связываем с переданной переменной
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    //тут рендерим вид эмеил уведомления и передавать какие-либо параметры
    public function build()
    {
        // subject('Новое сообщение с сайта MindSpace') - Устанавливаем тему письма. Можно и без него.
        return $this->subject('Новое сообщение с сайта MindSpace')
            ->view('emails.contact_form')
            ->with($this->formData); // передаём массив с данными
        // и в виде emails.contact_form работаем уже с переменными $message и $email
    }
}

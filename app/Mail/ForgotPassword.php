<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    //в живом примере можно добавить к паролю текст -  "вы пытаетесь восстановить пароль, вот вам новый пароль"
    public function build()
    {
        //        return $this->view('emails.forgot')->with([
        //            "password" => $this->password
        //        ]);

        return $this->subject('Ваш новый пароль для MS_Base') // Заголовок письма
            ->view('emails.forgot') // Использование шаблона
            ->with(["password" => $this->password]); // Передача данных в шаблон
    }
}

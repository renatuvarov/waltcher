<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Created extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $login;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $role;

    public function __construct(string $login, string $email, string $role)
    {
        $this->login = $login;
        $this->email = $email;
        $this->role = $role;
    }

    public function build()
    {
        return $this->markdown('emails.admin.created')->with([
            'login' => $this->login,
            'email' => $this->email,
            'role' => $this->role,
        ])->subject('Данные пользователя');
    }
}

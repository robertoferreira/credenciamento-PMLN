<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class newUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject("Novo cadastro - {$this->user->company->name_business}");
        $this->cc('roberto@housecriative.com.br');
        $this->to($this->user->email, $this->user->name);

        return $this->markdown('mail.user-registered', [
            'user' => $this->user,
            'company' => $this->user->company
        ]);
    }
}

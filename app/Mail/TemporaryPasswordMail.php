<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TemporaryPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tempPassword;

    /**
     * Create a new message instance.
     *
     * @param  string  $tempPassword
     * @return void
     */
    public function __construct($tempPassword)
    {
        $this->tempPassword = $tempPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre mot de passe temporaire')
                    ->view('mail.temporary_password');
    }
}

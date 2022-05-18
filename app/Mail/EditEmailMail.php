<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EditEmailMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $auth_code)
    {
        $this->auth_code = $auth_code;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('furusho7610@gmail.com')
        ->subject('Laravel課題用')
        ->view('emails.edit_email')
        ->with(['auth_code' => $this->auth_code]);;
    }
}

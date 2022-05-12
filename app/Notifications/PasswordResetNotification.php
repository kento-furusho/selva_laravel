<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class PasswordResetNotification extends ResetPassword
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */


    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // if (static::$toMailCallback) {
        //     return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        // }
        return (new MailMessage)
                ->subject('パスワード再設定')
                ->view('emails.password_reset', [
                    'reset_url' => url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false))
                ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

}

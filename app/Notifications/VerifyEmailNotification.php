<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmailNotification extends VerifyEmail
{
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifikasi Akun Tiketara')
            ->greeting('Halo!')
            ->line('Terima kasih telah mendaftar di Tiketara.')
            ->line('Silakan verifikasi email Anda untuk mulai menggunakan platform.')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini.');
    }
}
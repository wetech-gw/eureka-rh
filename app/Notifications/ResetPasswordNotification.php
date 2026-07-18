<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     */
    public string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('password.reset', ['token' => $this->token]);

        return (new MailMessage)
            ->subject('Eureka RH - Redefinição de Palavra-passe')
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line('Recebemos um pedido de redefinição de palavra-passe para a sua conta na plataforma Eureka RH.')
            ->action('Redefinir Palavra-passe', $url)
            ->line('Este link expira em 60 minutos.')
            ->line('Se não foi você que solicitou esta alteração, ignore este e-mail.')
            ->salutation('Equipa Eureka RH');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'token' => $this->token,
        ];
    }
}

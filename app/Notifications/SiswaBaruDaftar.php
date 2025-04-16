<?php

namespace App\Notifications;

use App\Models\Register;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SiswaBaruDaftar extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $siswa;
    public function __construct(Register $siswa)
    {
        $this->siswa = $siswa;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }


    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Siswa Baru Mendaftar',
            'body' => 'Siswa bernama ' . $this->siswa->siswa->nama . ' telah mendaftar.',
            'siswa_id' => $this->siswa->id,
        ];
    }
}

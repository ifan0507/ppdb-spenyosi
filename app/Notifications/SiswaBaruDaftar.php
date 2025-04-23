<?php

namespace App\Notifications;

use App\Models\Pendaftaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SiswaBaruDaftar extends Notification
{
    use Queueable;

    protected $pendaftaran;
    protected $status;

    public function __construct(Pendaftaran $pendaftaran, $status)
    {
        $this->pendaftaran = $pendaftaran;
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->pendaftaran->id,
            'title' => $this->pendaftaran->register->siswa->nama,
            'body' => 'No Register : ' . $this->pendaftaran->register->no_register,
            'jalur' => 'Jalur       : ' . $this->pendaftaran->register->jalur->nama_jalur,
            'status' => $this->status
        ];
    }
}

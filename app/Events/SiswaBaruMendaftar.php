<?php

namespace App\Events;

use App\Models\Pendaftaran;
use App\Models\Register;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SiswaBaruMendaftar implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $siswa;
    public $status;
    public function __construct($siswa, $status)
    {
        $this->siswa = $siswa;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */


    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin-channel'),
        ];
    }

    // public function broadcastWith()
    // {
    //     return [
    //         'id' => $this->siswa->register->id,
    //         'no_register' => $this->siswa->register->no_register,
    //         'nama' => $this->siswa->register->siswa->nama,
    //     ];
    // }
}

<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin-channel', function ($user) {
    return $user && $user instanceof \App\Models\User;
});

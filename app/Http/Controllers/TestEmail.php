<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Controller
{
    public function index()
    {
        Mail::raw('Tes email dari Laravel', function ($message) {
            $message->to('ipan.lmj0507@gmail.com')
                ->subject('Tes Email Laravel');
        });

        return "Email berhasil dikirim!";
    }
}

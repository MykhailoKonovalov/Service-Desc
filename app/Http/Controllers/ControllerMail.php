<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

class ControllerMail extends Controller
{
    public function send($problem, $solution, $user) {
        $toEmail = $problem->email;
        Mail::to($toEmail)->send(new FeedbackMail($problem, $solution, $user));
        return 'Сообщение отправлено на адрес '. $toEmail;
    }
}

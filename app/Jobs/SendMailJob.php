<?php

namespace App\Jobs;
use App\Mail\EnviarMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $bl;

    public function __construct($email, $bl)
    {
        $this->email = $email;
        $this->bl = $bl;
    }


    public function handle(): void
    {
        Mail::to($this->email)->send(new EnviarMail($this->bl));

    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailVerify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $token;
    protected $subject;
    protected $view;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $token, $subject, $view)
    {
        $this->email = $email;
        $this->token = $token;
        $this->subject = $subject;
        $this->view= $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send($this->view, ['token' => $this->token], function ($message) {
            $message->to($this->email);
            $message->subject($this->subject);
        });
    }
}

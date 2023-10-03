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
        $this->view = $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = url('reset-password/?token=' . $this->token);

        $message = (new MailMessage)
            ->line('You are receiving this email because we received a password reset request for your account.')
            ->action('Reset Password', url($url))
            ->line('If you did not request a password reset, no further action is required.');

        Mail::to($this->user->email)->send($message);
    }
}

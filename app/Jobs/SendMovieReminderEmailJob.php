<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMovieReminderEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    protected $subject;

    protected $view;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $subject, $view)
    {
        $this->email = $email;
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
        Log::info('Sending email to: ' . $this->email); // Đặt log để tracking xem nó có vào được function hay không
        // Mail::send phải truyền đúng params (Template, [Variable List (array)], callback)
        Mail::send($this->view, [], function ($message) {
            $message->to($this->email);
            $message->subject($this->subject);
        });
    }
}

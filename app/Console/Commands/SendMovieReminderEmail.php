<?php

namespace App\Console\Commands;

use App\Jobs\SendMovieReminderEmailJob;
use App\Services\ShowtimeService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SendMovieReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:reminder';

    protected ShowtimeService $showtimeService;

    protected $subject = 'Nhắc xem phim';

    protected $mailTemplate = 'email.reminder_email'; // truyền template vào cho cái queue job

    public function __construct(ShowtimeService $showtimeService)
    {
        parent::__construct();
        $this->showtimeService = $showtimeService;
    }
    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Lấy tất cả suất chiếu bắt đầu trong vòng 30 phút tiếp theo.
        $listEmails = $this->showtimeService->userEmailFromShowtime();
        // Đặt log thời gian start, thời gian end
        Log::info('--------Mail sender job start--------');
        // Log list user trước khi sned
        Log::info('List sender: ' . $listEmails);
        foreach ($listEmails as $email) {
            dispatch(new SendMovieReminderEmailJob($email, $this->subject, $this->mailTemplate));
        }
        Log::info('--------Mail sender job end--------');
    }
}

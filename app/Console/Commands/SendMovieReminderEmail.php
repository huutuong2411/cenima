<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use carbon\Carbon;
use App\Services\ShowtimeService;

class SendMovieReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:reminder';
    protected ShowtimeService $showtimeService;


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
    protected $description = 'Nhắc xem phim';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Lấy tất cả suất chiếu bắt đầu trong vòng 30 phút tiếp theo.
        $currentTime = Carbon::now();

        $addtime = $currentTime->addMinutes(30);

        $showtimes = $this->showtimeService->showtimeByDateTime($addtime->toTimeString(), $currentTime->toDateString());

        $emails = [];
        foreach ($showtimes as $showtime) {
            // Kiểm tra xem có tồn tại biến order trong suất chiếu
            if ($showtime->order) {
                $user = $showtime->order->user;
                $emails[] = $user->email;
            }
        }

        // Gửi email tới danh sách $emails
        Mail::send('email.reminder_email', [], function ($message) use ($emails) {
            $message->to($emails)->subject('Nhắc xem phim');
        });
    }
}

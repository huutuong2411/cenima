<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailForDues;
use Illuminate\Http\Request;

class SendEmailController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSendEmail()
    {
        return view('formDoino');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postSendEmail(Request $request)
    {
        // Chuyển thời gian về giây.
        $time = $request->time;

        for ($i = 0; $i < $request->amount; $i++) {
            // Tạo một bản sao của dữ liệu để tránh thay đổi trong vòng lặp.
            $data = $request->all();

            // Tạo một công việc cho từng lần gửi email.
            dispatch(new SendMailForDues($data))->delay(now()->addSeconds($time * $i));
        }

        return redirect()->route('get_send_email');
    }
}

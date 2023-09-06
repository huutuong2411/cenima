<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class NotificationSendController extends Controller
{
    protected UserService $userService;

    /**
     * __construct
     *
     * @param UserService $exampleService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function updateDeviceToken(Request $request)
    {
        $data = ['device_token' => $request->token];
        $this->userService->updateUser(Auth::user()->id, $data);

        return response()->json(['Token successfully stored.']);
    }

    public function sendNotification()
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken =  $this->userService->pluckNotNull('device_token')->all();

        $serverKey = 'AAAAespSmc8:APA91bHv7eoQ7TqGe5alys6p3Hhx1vJOw7Zydf90EQS9SCJVTYGgqISN28j2LXS9zrphwQiz6N2xo1Eui2Kg1Of3ltELdAjP-72f2JFA1jqNH5XvbR0ol_D1YJnyBUkCc4ena9mO11k0'; // ADD SERVER KEY HERE PROVIDED BY FCM

        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => 'Đơn hàng mới',
                "body" => Auth()->user()->name . ' đã mua vé',
            ]
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
        // FCM response
        return back();
    }
}

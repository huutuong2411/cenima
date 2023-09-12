<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\ShowtimeService;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Session;

class OrderController extends Controller
{
    protected OrderService $orderService;

    protected ShowtimeService $showtimeService;

    public function __construct(OrderService $orderService, ShowtimeService $showtimeService)
    {
        $this->orderService = $orderService;
        $this->showtimeService = $showtimeService;
    }

    public function getListMyTicket()
    {
        $userID = Auth::user()->id;
        $orders = $this->orderService->whereUserID($userID);

        return view('user.ticket.show-ticket', compact('orders'));
    }

    public function create()
    {
        //
    }

    public function createOrder(Request $request)
    {
        $showtimeID = $request->showtimeID;
        $seats = $request->seats;
        $showtimePrice = $this->showtimeService->findShowtime($showtimeID)->price;
        $seatCount = array_reduce($request->seats, function ($carry, $seats) {
            return $carry + count($seats);
        }, 0);
        $total = $showtimePrice * $seatCount;
        //xử lý số ghế đã được đặt
        $bookedTicket = $this->orderService->orderByShowtimeID($showtimeID);
        $bookedTicketArray = [];
        $duplicateSeats = [];
        foreach ($bookedTicket as $order) { //duyệt 1 vòng để ghép mảng
            $orderArray = json_decode($order, true);
            $bookedTicketArray = array_merge_recursive($bookedTicketArray, $orderArray);
        }
        foreach ($seats as $index => $seat) { //duyệt check trùng ghế hay không?
            foreach ($seat as $key => $value) {
                if (isset($bookedTicketArray[$index]) && in_array($value, $bookedTicketArray[$index])) {
                    $duplicateSeats[] = $index . $value;
                    unset($seat[$key]);
                }
            }
        }
        if (!empty($duplicateSeats)) {
            $duplicateSeats = implode(', ', $duplicateSeats);

            return redirect()->back()->with('error', __('Ghế ' . $duplicateSeats . ' đã có người đặt, vui lòng chọn ghế khác'));
        }
        //tiến hành lưu
        $data = [
            'id_showtime' => $showtimeID,
            'user_id' => Auth::user()->id,
            'ticket' => json_encode($seats),
            'total' => $total,
            'quantity' => $seatCount,
        ];
        // lưu vào session rồi đưa qua thanh toán online
        session(['order' => $data]);
        $data_url = VNPAY::vnpay_create_payment([
            'vnp_TxnRef' => Str::random(8), //Mã đơn hàng
            'vnp_OrderInfo' => 'Thanh toán đơn hàng', //Mô tả hoá đơn
            'vnp_Amount' => $total, // Tổng tiền thanh toán
        ]);

        return redirect()->to($data_url);
    }

    //check kết quả VNPAY
    public function vnPayCheck(Request $request)
    {
        //lấy data từ URL(do VNPay gửi về qua $vnp_Returnurl)
        $vnp_ResponseCode = $request->get('vnp_ResponseCode'); //mã phản hồi kết quả. 00= thành công;
        $vnp_TxnRef = $request->get('vnp_TxnRef'); //mã đơn hàng
        $vnp_Amount = $request->get('vnp_Amount'); //số tiền thanh toán
        // kiểm tra kết quả giao dịch:
        if ($vnp_ResponseCode == 00) { //nếu thành công
            $order = Session::get('order');
            // lưu
            $saveNewOrder = $this->orderService->createOrder($order);
            if ($saveNewOrder) {
                // xoá data
                $request->session()->forget('order');
                // gửi realtime thông báo:
                return redirect()->route('user.send_web_notification', ['id' => $saveNewOrder->id]);
            } else {
                // xoá data
                $request->session()->forget('order');

                return redirect()->back()->with('error', __('Có lỗi xảy ra vui lòng thử lại'));
            }
        } else {
            return redirect()->back()->with('error', __('Lỗi thanh toán - vui lòng thử lại'));
        }
    }

    public function showTicket($id)
    {
        $order = $this->orderService->findOrder($id);

        return view('user.ticket.ticket', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

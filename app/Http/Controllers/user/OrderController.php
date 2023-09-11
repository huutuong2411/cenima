<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\RoomsService;
use App\Services\ShowtimeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected OrderService $orderService;

    protected ShowtimeService $showtimeService;

    public function __construct(OrderService $orderService, ShowtimeService $showtimeService, RoomsService $roomsService)
    {
        $this->orderService = $orderService;
        $this->showtimeService = $showtimeService;
        $this->roomsService = $roomsService;
    }

    public function getlistTicket()
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
        ];
        $saveNewOrder = $this->orderService->createOrder($data);
        if ($saveNewOrder) {
            return redirect()->route('user.show_ticket', ['id' => $saveNewOrder->id])->with('success', __('Đặt vé thành công'));
        } else {
            return redirect()->back()->with('error', __('Đặt vé không thành công'));
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

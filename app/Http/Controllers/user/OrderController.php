<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use App\Services\ShowtimeService;

class OrderController extends Controller
{
    protected OrderService $orderService;
    protected ShowtimeService $showtimeService;

    public function __construct(OrderService $orderService, ShowtimeService $showtimeService)
    {
        $this->orderService = $orderService;
        $this->showtimeService = $showtimeService;
    }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function createOrder(Request $request)
    {
        $showtimeID = $request->showtimeID;
        $showtimePrice = $this->showtimeService->findShowtime($showtimeID)->price;
        $seatCount = array_reduce($request->seats, function ($carry, $seats) {
            return $carry + count($seats);
        }, 0);
        $total = $showtimePrice * $seatCount;
        $data = [
            'id_showtime' => $showtimeID,
            'user_id' => Auth::user()->id,
            'ticket' => json_encode($request->seats),
            'total' => $total,
        ];
        if ($this->orderService->createOrder($data)) {
            return redirect()->back()->with('success', __('Đặt vé thành công'));
        } else {
            return redirect()->back()->with('error', __('Đặt vé không thành công'));
        }
    }

    public function show($id)
    {
        //
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

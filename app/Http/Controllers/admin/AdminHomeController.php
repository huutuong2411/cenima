<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use App\Services\MovieService;
use Illuminate\Http\Request;
use carbon\Carbon;
use Carbon\CarbonPeriod;

class AdminHomeController extends Controller
{
    protected OrderService $orderService;
    protected MovieService $movieService;

    public function __construct(MovieService $movieService, OrderService $orderService)
    {
        $this->orderService = $orderService;
        $this->movieService = $movieService;
    }

    public function index()
    {
        //tổng doanh thu tháng
        $monthRevenue = $this->orderService->monthRevenue(date('m'), date('Y'));
        //tổng doanh thu theo tuần này
        $weekRevenue = $this->orderService->weekRevenue();
        //đếm số vé phim
        $movieCount = $this->movieService->whereDate(now())->count('id');
        //đếm số vé đã bán
        $tickets = $this->orderService->getAll()->pluck('ticket');
        $ticketCount = 0;
        foreach ($tickets as $ticket) {
            $ticketData = json_decode($ticket, true); // Chuyển chuỗi JSON thành mảng
            foreach ($ticketData as $seats) {
                $ticketCount += count($seats);
            }
        }
        // danh sách các năm đã qua:
        $yearList = $this->orderService->getListYears();
        // thống kê doanh thu tháng hiện tại
        $monthEarn = [];
        for ($i = 1; $i <= 12; $i++) {
            $thismonthEarn = $this->orderService->monthRevenue($i, date('Y'));
            $monthEarn[] = $thismonthEarn;
        }

        return view('admin.dashboard', compact('monthRevenue', 'weekRevenue', 'movieCount', 'ticketCount', 'yearList', 'monthEarn'));
    }

    public function Earning(Request $request)
    {
        if (!empty($request->year) && empty($request->month)) {
            $monthEarn = [];
            for ($i = 1; $i <= 12; $i++) {
                $thismonthEarn = $thismonthEarn = $this->orderService->monthRevenue($i, $request->year);
                $monthEarn[] = $thismonthEarn;
            }
            return response()->json($monthEarn);
        }
        // xử lý theo từng tháng:
        if (!empty($request->year) && !empty($request->month)) {
            $firstday = new Carbon('first day of ' . $request->month . ' ' . $request->year);
            $lastday = new Carbon('last day of ' . $request->month . ' ' . $request->year);
            $period = CarbonPeriod::create($firstday, $lastday);
            $dayEarn = [];
            $listday = [];
            foreach ($period as $value) {
                $date = $value->format('Y-m-d');
                $thisdayEarn = $this->orderService->dateRevenue($date);
                $dayEarn[] = $thisdayEarn;
                $listday[] = $value->day;
            }

            return response()->json(['dayEarn' => $dayEarn, 'listday' => $listday]);
        }

        // bán chạy
        $bestsellers = Product::select('products.name', \DB::raw('SUM(order_details.qty) as soldqty'))
            ->join('product_details', 'products.id', '=', 'product_details.id_product')
            ->join('order_details', 'order_details.id_product_detail', '=', 'product_details.id')
            ->join('order', 'order_details.id_order', '=', 'order.id')
            ->where('order.status', 2)
            ->whereYear('order.created_at', $thisYear)
            ->groupBy('products.id')
            ->orderBy('products.created_at', 'DESC')
            ->limit(10)
            ->get();
        $listproduct = [];
        $soldqty = [];
        foreach ($bestsellers as $value) {
            $listproduct[] = $value->name;
            $soldqty[] = $value->soldqty;
        }
    }
}

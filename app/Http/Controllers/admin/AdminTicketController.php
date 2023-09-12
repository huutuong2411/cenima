<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\OrderService;

class AdminTicketController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $tickets = $this->orderService->getAll();

        return view('admin.ticket.ticket', compact('tickets'));
    }
}

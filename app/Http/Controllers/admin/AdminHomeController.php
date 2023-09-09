<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

class AdminHomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $movie = $this->movieService->whereDate(Carbon::now());

        return view('user.home', compact('movie'));
    }
}

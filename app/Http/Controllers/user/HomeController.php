<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use App\Services\ShowtimeService;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected MovieService $movieService;

    protected ShowtimeService $showtimeService;

    public function __construct(MovieService $movieService, ShowtimeService $showtimeService)
    {
        $this->movieService = $movieService;
        $this->showtimeService = $showtimeService;
    }

    public function index()
    {
        $movie = $this->movieService->whereDate(Carbon::now())->take(4);

        return view('user.home', compact('movie'));
    }
}

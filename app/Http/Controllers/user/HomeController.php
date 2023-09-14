<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\MovieService;
use Carbon\Carbon;
use App\Services\ShowtimeService;

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
        // test thử gửi mail nhắc xem phim

        $test = $this->showtimeService->userEmailFromShowtime();
        dd($test);




        return view('user.home', compact('movie'));
    }
}

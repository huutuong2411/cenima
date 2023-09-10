<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CitiesService;
use App\Services\MovieService;
use App\Services\RoomsService;
use App\Services\ShowtimeService;
use App\Services\TheatersService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminShowTimeController extends Controller
{
    protected ShowtimeService $showtimeService;

    protected CitiesService $citiesService;

    protected MovieService $movieService;

    protected TheatersService $theatersService;

    protected RoomsService $roomsService;

    public function __construct(ShowtimeService $showtimeService, CitiesService $citiesService, MovieService $movieService, TheatersService $theatersService, RoomsService $roomsService)
    {
        $this->showtimeService = $showtimeService;
        $this->citiesService = $citiesService;
        $this->movieService = $movieService;
        $this->theatersService = $theatersService;
        $this->roomsService = $roomsService;
    }

    public function index()
    {
        $showtime = $this->showtimeService->ShowtimeByTheater();

        return view('admin.showtime.showtime', compact('showtime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = $this->citiesService->getAll();
        $movie = $this->movieService->whereDate(Carbon::now());

        return view('admin.showtime.add', compact('city', 'movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //call ajax city -> theaters
        if (!empty($request->id_city)) {
            $theaters = $this->citiesService->findCity($request->id_city)->theaters;

            return response()->json($theaters);
        }
        //call ajax theater -> room
        if (!empty($request->id_theater)) {
            $rooms = $this->theatersService->findTheater($request->id_theater)->rooms;

            return response()->json($rooms);
        }
        //call ajax render giờ kết thúc
        if (!empty($request->movie_id) && !empty($request->start_time)) {
            $movie = $this->movieService->findMovie($request->movie_id);
            $startTime = Carbon::parse($request->start_time);
            $endTime = $startTime->addMinutes($movie->time);

            return response()->json(['end_time' => $endTime->toTimeString()]);
        }

        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $price = $request->price;
        foreach ($endTime as $key => $value) {
            $endTime[$key] = Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
        $movie = $request->movie;
        $data = [
            'id_room' => $request->room,
            'date' => $request->date,
            'user_id' => Auth::user()->id,
        ];
        $flag = false;
        foreach ($startTime as $index => $start) {
            $end = $endTime[$index];
            // Kiểm tra xem suất chiếu hiện tại có trùng lặp với các suất chiếu khác không
            for ($i = 0; $i < count($startTime); $i++) {
                if ($i != $index) {
                    if (($start >= $startTime[$i] && $start <= $endTime[$i]) ||
                        ($end >= $startTime[$i] && $end <= $endTime[$i])) {
                        $flag = true;
                        break;
                    }
                }
            }
            if ($flag) {
                return redirect()->back()->with('error', __('Giờ chiếu không được trùng lặp'));
                break; // Khi gặp xung đột đầu tiên, thoát khỏi vòng lặp
            }
        }

        foreach ($startTime as $index => $start) {
            //Nếu không trùng nhau
            $data['start_at'] = $start;
            $data['end_at'] = $endTime[$index];
            $data['id_movie'] = $movie[$index];
            $data['price'] = $price[$index];
            $this->showtimeService->createShowtime($data);
        }

        return redirect()->route('admin.showtime')->with('success', __('Thêm suất chiếu thành công'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($idTheater, $date)
    {
        $roomID = $this->roomsService->getShowTimeByTheater($idTheater)->pluck('id');

        $showtime = $this->showtimeService->showTimeByIdRoom($roomID, $date);
        dd($showtime);
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

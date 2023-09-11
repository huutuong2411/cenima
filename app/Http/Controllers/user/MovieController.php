<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Services\CitiesService;
use App\Services\MovieService;
use App\Services\OrderService;
use App\Services\RoomsService;
use App\Services\ShowtimeService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected MovieService $movieService;

    protected OrderService $orderService;

    protected CitiesService $citiesService;

    protected ShowtimeService $showtimeService;

    protected RoomsService $roomsService;

    public function __construct(
        MovieService $movieService,
        CitiesService $citiesService,
        ShowtimeService $showtimeService,
        RoomsService $roomsService,
        OrderService $orderService
    ) {
        $this->orderService = $orderService;
        $this->movieService = $movieService;
        $this->citiesService = $citiesService;
        $this->showtimeService = $showtimeService;
        $this->roomsService = $roomsService;
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxOrder(Request $request)
    {
        //call ajax city -> theaters
        if (!empty($request->id_city)) {
            $theaters = $this->citiesService->findCity($request->id_city)->theaters;

            return response()->json($theaters);
        }

        //call ajax theater -> showtime by movie
        if (!empty($request->id_theater) && !empty($request->id_movie)) {
            $roomID = $this->roomsService->getShowTimeByTheater($request->id_theater)->pluck('id');

            $dateShowtime = $this->showtimeService->dateByRoomAndIdMovie($roomID, $request->id_movie);

            return response()->json($dateShowtime);
        }

        //call ajax get showtimes by movie + theater + date
        if (!empty($request->theaterID) && !empty($request->id_movie) && !empty($request->date_selected)) {
            $roomID = $this->roomsService->getShowTimeByTheater($request->theaterID)->pluck('id');

            $showtimes = $this->showtimeService->showTimeByMovieDate($roomID, $request->date_selected, $request->id_movie);

            return response()->json($showtimes);
        }

        //call movie infor and seats by id_showtime
        if (!empty($request->id_showtime)) {
            $showtimeID = $request->id_showtime;
            $showtime = $this->showtimeService->findShowtime($showtimeID);
            $price = $showtime->price;
            $startTime = $showtime->start_at;
            $date = $showtime->date;
            $room = $this->roomsService->findRoom($showtime->id_room);
            $roomSeats = json_decode($room->seats);
            $roomName = $room->name;
            $theaterName = $room->theaters->name;
            $theaterAddress = $room->theaters->address;
            //xử lý số ghế đã được đặt
            $bookedTicket = $this->orderService->orderByShowtimeID($showtimeID);
            $bookedTicketArray = [];
            foreach ($bookedTicket as $order) {
                $orderArray = json_decode($order, true);
                $bookedTicketArray = array_merge_recursive($bookedTicketArray, $orderArray);
            }
            //
            $data = [
                'id_showtime' => $showtimeID,
                'price' => $price,
                'start_time' => $startTime,
                'room_seets' => $roomSeats,
                'room_name' => $roomName,
                'theater_name' => $theaterName,
                'theater_address' => $theaterAddress,
                'date' => $date,
                'booked_ticket' => $bookedTicketArray
            ];

            return response()->json($data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movieService->findMovie($id);
        $city = $this->citiesService->getAll();
        return view('user.movie.movieDetail', compact('movie', 'city'));
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

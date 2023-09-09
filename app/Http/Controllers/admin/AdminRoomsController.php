<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\admin\City;
use App\Services\CitiesService;
use App\Services\RoomsService;
use App\Services\TheatersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRoomsController extends Controller
{
    protected RoomsService $roomsService;

    protected TheatersService $theatersService;

    protected CitiesService $citiesService;

    public function __construct(RoomsService $roomsService, TheatersService $theatersService, CitiesService $citiesService)
    {
        $this->roomsService = $roomsService;
        $this->theatersService = $theatersService;
        $this->citiesService = $citiesService;
    }

    public function index()
    {
        $rooms = $this->roomsService->withTheater()->get();
        // dd($rooms);
        return view('admin.rooms.rooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $city = $this->citiesService->getAll();

        return view('admin.rooms.add', compact('city'));
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

        $data = [
            'name' => $request->name,
            'seat_qty' => $request->total_seats,
            'seats' => json_encode($request->seats),
            'id_theater' => $request->theaters,
            'user_id' => Auth::user()->id,
        ];

        if ($this->roomsService->createRoom($data)) {
            return redirect()->back()->with('success', __('Thêm phòng thành công'));
        } else {
            return redirect()->back()->with('error', __('Thêm phòng không thành công'));
        }
    }

    public function show($id)
    {
        $room = $this->roomsService->findRoom($id);

        return view('admin.rooms.roomDetail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = $this->roomsService->findRoom($id);
        $theaters = $this->theatersService->getAll();
        $cities = $this->citiesService->getAll();

        return view('admin.rooms.edit', compact('room', 'theaters', 'cities'));
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
        $data = [
            'name' => $request->name,
            'seat_qty' => $request->total_seats,
            'seats' => json_encode($request->seats),
            'id_theater' => $request->theaters,
            'user_id' => Auth::user()->id,
        ];
        if ($this->roomsService->updateRoom($id, $data)) {
            return redirect()->back()->with('success', __('Sửa phòng thành công'));
        } else {
            return redirect()->back()->with('error', __('Sửa phòng không thành công'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->roomsService->deleteRoom($id);

        return redirect()->back()->with('delete', __('Đã xoá phòng chiếu thành công'));
    }

    // thùng rác
    public function trash()
    {
        $trash = $this->roomsService->roomTrash();

        return view('admin.rooms.trash', compact('trash'));
    }

    // khôi phục
    public function restore(string $id)
    {
        $this->roomsService->restoreRoom($id);

        return redirect()->back()->with('success', __('khôi phục thành công'));
    }
}

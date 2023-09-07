<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\City;
use App\Services\RoomsService;
use App\Services\TheatersService;
use App\Services\CitiesService; 

class AdminRoomsController extends Controller
{
    protected RoomsService $roomsService ;
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
        $rooms = $this->roomsService->getAll();

       return view('admin.rooms.rooms',compact('rooms'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //call ajax city -> theaters
        if(!empty($request->id_city)){
        $theaters= $this->citiesService->findCity($request->id_city)->theaters;
        return response()->json($theaters);
        }
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CitiesService;

class CityController extends Controller
{
    protected CitiesService $citiesService;

    public function __construct(CitiesService $citiesService)
    {
        $this->citiesService = $citiesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->citiesService->getAll();

        return
            $result = [
                'status' => true,
                'message' => 'Danh sách thành phố',
                'data' => $cities,
            ];

        return response()->json($result, 200);
    }
}

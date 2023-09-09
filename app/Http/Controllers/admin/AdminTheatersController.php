<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CitiesService;
use App\Services\TheatersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTheatersController extends Controller
{
    protected TheatersService $theatersService;

    protected CitiesService $citiesService;

    public function __construct(TheatersService $theatersService, CitiesService $citiesService)
    {
        $this->theatersService = $theatersService;
        $this->citiesService = $citiesService;
    }

    public function index()
    {
        $city = $this->citiesService->getAll();
        $theaters = $this->theatersService->getAll();

        return view('admin.theaters.theaters', compact('theaters', 'city'));
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
    public function store(Request $request)
    {
        $data = [
            'name' => $request->theater,
            'address' => $request->address,
            'id_city' => $request->city,
            'user_id' => Auth::user()->id,
        ];
        if ($this->theatersService->createTheater($data)) {
            return redirect()->back()->with('success', __('Thêm rạp thành công'));
        } else {
            return redirect()->back()->withErrors('Thêm rạps không thành công');
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
        //
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
        $data = [
            'name' => $request->name,
            'id_city' => $request->city,
            'address' => $request->address,
        ];
        if ($this->theatersService->updateTheater($id, $data)) {
            return redirect()->back()->with('success', __('Sửa rạp chiếu thành công'));
        } else {
            return redirect()->back()->with('error', __('Sửa rạp chiếu không thành công'));
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
        $this->theatersService->deleteTheater($id);

        return redirect()->back()->with('delete', __('Đã xoá danh mục thành công'));
    }

    // thùng rác
    public function trash()
    {
        $trash = $this->theatersService->theaterTrash();

        return view('admin.theaters.trash', compact('trash'));
    }

    // khôi phục
    public function restore(string $id)
    {
        $this->theatersService->restoreTheater($id);

        return redirect()->back()->with('success', __('khôi phục thành công'));
    }
}

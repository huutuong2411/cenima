<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TheatersService;
use Illuminate\Http\Request;

class TheaterController extends Controller
{
    protected TheatersService $theatersService;

    public function __construct(TheatersService $theatersService)
    {
        $this->theatersService = $theatersService;
    }

    // ----------------------------------------------------------------
    public function index()
    {
        $theaters = $this->theatersService->getAll();
        $result = [
            'status' => true,
            'message' => 'Danh sách rap',
            'data' => $theaters,
        ];

        return response()->json($result, 200);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->theater,
            'address' => $request->address,
            'id_city' => $request->city,
            'user_id' => Auth::user()->id,
        ];
        $thisTheater = $this->theatersService->createTheater($data);

        $array = [
            'status' => true,
            'message' => 'Lưu danh mục thành công',
            'data' => $thisTheater,
        ];

        return response()->json($array, 201);
    }

    public function show($id)
    {
        $thisTheater = $this->theatersService->showTheater($id);
        $array = [
            'status' => true,
            'message' => 'Chi tiết danh mục',
            'data' => $thisTheater->load('Cities'),
        ];

        return response()->json($array, 200);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'id_city' => $request->city,
            'address' => $request->address,
            'user_id' => Auth::user()->id,
        ];
        $thisCategory = $this->theatersService->updateTheater($id, $data);
        $array = [
            'status' => true,
            'message' => 'Sửa danh mục thành công',
            'data' => $thisCategory,
        ];

        return response()->json($array, 201);
    }

    public function destroy($id)
    {
        $this->theatersService->deleteTheater($id);
        $arr = [
            'status' => true,
            'message' => 'Rap đã được xóa',
            'data' => [],
        ];

        return response()->json($arr, 200);
    }

    // thùng rác
    public function trash()
    {
        $trash = $this->theatersService->theaterTrash();

        return response()->json([
            'status' => true,
            'message' => 'Danh sach rap da xoa',
            'data' => $trash,
        ], 200);
    }

    // khôi phục
    public function restore($id)
    {
        $this->theatersService->restoreTheater($id);

        return response()->json([
            'status' => true,
            'message' => 'Khoi phuc rap thanh cong',
            'data' => [],
        ], 200);
    }
}

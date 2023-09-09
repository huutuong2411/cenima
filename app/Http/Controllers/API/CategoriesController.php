<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\admin\CategoriesRequest;
use App\Http\Resources\Categories as CategoriesResource;
use App\Services\CategoriesService;
use Illuminate\Http\Response;

class CategoriesController extends Controller
{
    protected CategoriesService $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    public function index()
    {
        $categories = $this->categoriesService->getAll();

        return
            $result = [
                'status' => true,
                'message' => 'Danh sách danh mục',
                'data' => CategoriesResource::collection($categories),
            ];

        return response()->json($result, Response::HTTP_OK);
    }

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
    public function store(CategoriesRequest $request)
    {
        $category = $request->name;
        $data = ['name' => $category, 'user_id' => '1'];

        $thisCategory = $this->categoriesService->createCategory($data);
        $array = [
            'status' => true,
            'message' => 'Lưu danh mục thành công',
            'data' => new CategoriesResource($thisCategory),
        ];

        return response()->json($array, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thisCategory = $this->categoriesService->showCategory($id);
        $array = [
            'status' => true,
            'message' => 'Chi tiết danh mục',
            'data' => new CategoriesResource($thisCategory),
        ];

        return response()->json($array, 200);
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
    public function update(CategoriesRequest $request, $id)
    {
        $category = $request->name;

        $data = ['name' => $category, 'user_id' => 1];

        $thisCategory = $this->categoriesService->updateCategory($id, $data);

        $array = [
            'status' => true,
            'message' => 'Sửa danh mục thành công',
            'data' => new CategoriesResource($thisCategory),
        ];

        return response()->json($array, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoriesService->deleteCategory($id);
        $arr = [
            'status' => true,
            'message' => 'Sản phẩm đã được xóa',
            'data' => [],
        ];

        return response()->json($arr, 200);
    }
}

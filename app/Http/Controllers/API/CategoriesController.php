<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    /**
     * @OA\Get(
     *     path="/api/categories",
     *     operationId="getCategories",
     *     tags={"Categories"},
     *     summary="Get a list of categories",
     *     description="Get a list of all categories.",
     *     security={{"passport":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="List of categories",
     *
     *        @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthorized"),
     *
     * )
     */
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
    /**
     * @OA\Post(
     *     path="/api/categories",
     *     operationId="createCategory",
     *     tags={"Categories"},
     *     summary="Create a new category",
     *     description="Create a new category.",
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Category created successfully",
     *
     *         @OA\JsonContent(),
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     * )
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
    /**
     * @OA\Get(
     *     path="/api/categories/{id}",
     *     operationId="getCategoryById",
     *     tags={"Categories"},
     *     summary="Get a category by ID",
     *     description="Get a category by its ID.",
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *
     *         @OA\Schema(type="integer"),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Category details",
     *
     *         @OA\JsonContent(),
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Category not found"),
     * )
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
    /**
     * @OA\Put(
     *     path="/api/categories/{id}",
     *     operationId="updateCategory",
     *     tags={"Categories"},
     *     summary="Update a category",
     *     description="Update an existing category by its ID.",
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *
     *         @OA\Schema(type="integer"),
     *     ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(),
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Category updated successfully",
     *
     *         @OA\JsonContent(),
     *     ),
     *
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Category not found"),
     *     @OA\Response(response=422, description="Unprocessable Entity"),
     * )
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
    /**
     * @OA\Delete(
     *     path="/api/categories/{id}",
     *     operationId="deleteCategory",
     *     tags={"Categories"},
     *     summary="Delete a category",
     *     description="Delete a category by its ID.",
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the category",
     *
     *         @OA\Schema(type="integer"),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Category deleted successfully",
     *     ),
     *     @OA\Response(response=401, description="Unauthorized"),
     *     @OA\Response(response=404, description="Category not found"),
     * )
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

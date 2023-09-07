<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoriesService;
use Illuminate\Support\Facades\Auth;

class AdminCategoriesController extends Controller
{
    protected CategoriesService $categoriesService;

    public function __construct(CategoriesService $categoriesService)
    {

        $this->categoriesService = $categoriesService;
    }

    public function index()
    {
        $categories = $this->categoriesService->getAll();
        return view('admin.categories.categories', compact('categories'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->category,
            'user_id' => Auth::user()->id,
        ];
        if ($this->categoriesService->createCategory($data)) {
            return redirect()->back()->with('success', __('Thêm danh mục thành công'));
        } else {
            return redirect()->back()->with('error', __('Thêm danh mục không thành công'));
        }
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
        $data = [
            'name' => $request->new_name,
        ];
        if ($this->categoriesService->updateCategory($id, $data)) {
            return redirect()->back()->with('success', __('Sửa danh mục thành công'));
        } else {
            return redirect()->back()->with('error', __('Sửa danh mục không thành công'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->categoriesService->deleteCategory($id);
        return redirect()->back()->with('delete', __('Đã xoá danh mục thành công'));
    }
    // thùng rác
    // public function trash()
    // {
    //     $trash=Category::onlyTrashed()->get();
    //     return view('Admin.category.trash',compact('trash'));
    // }
    // // khôi phục category
    // public function restore(string $id)
    // {
    //     Category::withTrashed()->find($id)->restore();
    //     Product::where('id_category',$id)->restore();
    //     return redirect()->back()->with('success',__('khôi phục thành công')); 
    // }
}

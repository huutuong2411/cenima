<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Services\CategoriesService;
// use Image;
use Illuminate\Support\Facades\Auth;

class AdminMovieController extends Controller
{
    protected MovieService $movieService;
    protected CategoriesService $categoriesService;

    public function __construct(MovieService $movieService, CategoriesService $categoriesService)
    {
        $this->movieService = $movieService;
        $this->categoriesService = $categoriesService;
    }

    public function index()
    {
        $movie = $this->movieService->getAll();
        return view('admin.movie.movie', compact('movie'));
    }

    public function create()
    {
        $categories = $this->categoriesService->getAll();
        return view('admin.movie.add', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'trailer' => $request->trailer,
            'id_category' => $request->id_category,
            'age_limit' => $request->age_limit,
            'start_date' => $request->start_date,
            'time' => $request->time,
            'price' => $request->price,
            'description' => $request->description,
        ];
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $time = strtotime(date('Y-m-d H:i:s'));
            $name = $time . "_" . $image->getClientOriginalName();
            $path = public_path('admin/assets/img/movies/' . $name);
            if (!is_dir('admin/assets/img/movies')) {
                mkdir('admin/assets/img/movies');
                // Image::make($image->getrealpath())->resize(524, 724)->save($path);
            }
            $data['image'] = $name;
        }
        $data['user_id'] = Auth::user()->id;
        if ($this->movieService->createMovie($data)) {
            return redirect()->route('admin.movie')->with('success', __('Thêm phim thành công'));
        } else {
            return redirect()->back()->withErrors('Thêm phim không thành công');
        }
    }
}

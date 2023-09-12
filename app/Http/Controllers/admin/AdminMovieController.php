<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\CategoriesService;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
        $movie = $this->movieService->getMovieAndSales();

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
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ];
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $time = strtotime(date('Y-m-d H:i:s'));
            $name = $time . '_' . $image->getClientOriginalName();
            $path = public_path('admin/assets/img/movies/' . $name);
            if (!is_dir('admin/assets/img/movies')) {
                mkdir('admin/assets/img/movies');
            }
            Image::make($image->getrealpath())->resize(524, 724)->save($path);
            $data['image'] = $name;
        }

        if ($this->movieService->createMovie($data)) {
            return redirect()->route('admin.movies')->with('success', __('Thêm phim thành công'));
        } else {
            return redirect()->back()->with('error', __('Thêm phim không thành công'));
        }
    }

    public function show($id)
    {
        $movie = $this->movieService->findMovie($id);

        return view('admin.movie.movieDetail', compact('movie'));
    }

    public function edit($id)
    {
        $movie = $this->movieService->findMovie($id);
        $categories = $this->categoriesService->getAll();

        return view('admin.movie.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'trailer' => $request->trailer,
            'id_category' => $request->id_category,
            'age_limit' => $request->age_limit,
            'start_date' => $request->start_date,
            'time' => $request->time,
            'description' => $request->description,
        ];

        $movie = $this->movieService->findMovie($id);
        if ($request->hasfile('image')) {
            if (file_exists('admin/assets/img/movies/' . $movie->image)) {
                unlink('admin/assets/img/movies/' . $movie->image);
            }
            $image = $request->file('image');
            $time = strtotime(date('Y-m-d H:i:s'));
            $name = $time . '_' . $image->getClientOriginalName();
            $path = public_path('admin/assets/img/movies/' . $name);
            if (!is_dir('admin/assets/img/movies')) {
                mkdir('admin/assets/img/movies');
            }
            Image::make($image->getrealpath())->resize(524, 724)->save($path);
            $data['image'] = $name;
        }
        $data['user_id'] = Auth::user()->id;
        if ($this->movieService->updateMovie($id, $data)) {
            return redirect()->back()->with('success', __('Sửa phim thành công'));
        } else {
            return redirect()->back()->with('error', __('Sửa phim không thành công'));
        }
    }

    public function destroy($id)
    {
        $this->movieService->deleteMovie($id);

        return redirect()->back()->with('delete', __('Đã xoá phim thành công'));
    }

    // thùng rác
    public function trash()
    {
        $trash = $this->movieService->movieTrash();

        return view('admin.movie.trash', compact('trash'));
    }

    // khôi phục
    public function restore(string $id)
    {
        $this->movieService->restoreMovie($id);

        return redirect()->back()->with('success', __('khôi phục thành công'));
    }
}

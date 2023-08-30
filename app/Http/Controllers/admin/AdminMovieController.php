<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

class AdminMovieController extends Controller
{
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
       
    }

    public function index()
    {  
        $movie= $this->movieService->getAll();
       return view('admin.movie.movie',compact('movie'));
    }
}

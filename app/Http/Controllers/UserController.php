<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\UserRequest;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserService $userService;

    /**
     * __construct
     *
     * @param UserService $exampleService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        if (Auth::check() && !empty(Auth::user()->email_verified_at)) {
            $filter = (object) [
                'name' => $request->name ?? '',
                'email' => $request->email ?? '',
                'start_at' => $request->start_at ?? '',
                'end_at' => $request->end_at ?? '',
                'page' => $request->page ?? 1,
                'per_page' => $request->per_page ?? 3,
            ];
            $result = $this->userService->getList($filter)->paginate($filter->per_page);

            return view('home', compact('result'));
        } else {
            return back()->withErrors('Opps! bạn không được phéo truy cap');
        }
    }

    /**
     *  Display the specified resource.
     *
     * @return View|JsonResponse
     */
    public function show($id)
    {
        $result = $this->userService->findExampleById($id);

        return view('show', compact('result'));
    }

    public function create()
    {
        return view('addInfor');
    }

    public function store(UserRequest $request)
    {
        $confirmation_code = time() . uniqid(true);
        $filter = $request->all();
        $filter['password'] = Hash::make($request->password);
        $filter['confirmation_code'] = $confirmation_code;

        if ($this->userService->addUser($filter)) {
            return redirect()->back()->with('success', 'Thêm thành công');
        } else {
            return back()->withErrors('Thêm không thành công');
        }
    }

    public function reset()
    {
        return view('resetPassword');
    }
}

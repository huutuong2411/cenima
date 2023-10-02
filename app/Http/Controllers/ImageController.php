<?php

namespace App\Http\Controllers;

use App\Models\ImageTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function upload()
    {
        Storage::disk('s3')->put('test-upload/test.txt', 'aloalo');
        return view('upload');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imageContents = file_get_contents($request->file('image')->getRealPath());

            // Đặt tên cho tệp trên S3 (ví dụ: "images/originals/filename.jpg")
            $path = 'images/originals/' . $request->file('image')->getClientOriginalName();

            // Lưu tệp lên S3 với nội dung đã đọc
            Storage::disk('s3')->put($path, $imageContents, 'public');

            $request->merge([
                'size' => $request->file('image')->getSize(),
                'path' => $path
            ]);
            ImageTest::create($request->only('path', 'title', 'image'));
            return back()->with('success', 'Image Successfully Saved');
        }
    }
}

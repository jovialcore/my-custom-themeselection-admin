<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {

        $images = Image::latest()->get();
        return view('upload', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $image = new Image;
        $image->name = $imageName;
        $image->path = '/images/' . $imageName;
        $image->save();

        return response()->json(['message' => 'Image uploaded successfully', 'image' => $image]);
    }
}

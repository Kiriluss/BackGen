<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function upload(Request $request){
        $path = $request->file('image')->store('public/img');
        Image::create(['src'=>$path]);
        return response()->json(['success'=>$request->file('image')]);

    }
    
}

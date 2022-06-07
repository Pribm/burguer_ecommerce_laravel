<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function getThumbnail(Request $request, $path = null)
    {
        $path = $path ? $path.'/' : null;
        $subpath = $request->subpath ? $request->subpath.'/' : null;
        $image = $request->image ? $request->image : null;

        $path = $path . $subpath . $image;

        $img = Storage::disk('public')->get($path);
        return Response::make($img, 200, ['Content-Type' => 'image'])->setMaxAge(864000)->setPublic();
    }
}

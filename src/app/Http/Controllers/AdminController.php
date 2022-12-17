<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Image\ImageModel;
use App\Components\Image\ImageService;
use App\Http\Requests\StatusRequest;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        try {
            $service = new ImageService();
            $data = $service->getImages();
        } catch (\Exception $e) {
            throw $e;
        }

        return view('admin', compact('data'));
    }

    public function imageCancel(string $id, StatusRequest $request)
    {
        try {
            $service = new ImageService();
            $data = $service->setStatus($request);
        } catch (\Exception $e) {
            throw $e;
        }

        return back();
    }
}

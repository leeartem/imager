<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Image\IImageRepository;
use App\Http\Requests\StatusRequest;

class AdminController extends Controller
{
    public function index(IImageRepository $imageRepository)
    {
        $data = $imageRepository->get();

        return view('admin', compact('data'));
    }

    public function imageCancel(
        string $id,
        StatusRequest $request,
        IImageRepository $imageRepository
    ) {
        $imageRepository->setStatus(
            $id,
            null,
            $request->get('status'),
        );

        return back();
    }
}

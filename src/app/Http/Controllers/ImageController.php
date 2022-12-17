<?php

namespace App\Http\Controllers;

use App\Components\Image\ImageService;
use App\Http\Requests\StatusRequest;

class ImageController extends Controller
{
    public function get()
    {
        try {
            $service = new ImageService();
            $data = $service->getImage('picsum')->toArray();
//            В реально проекте сюда наверняка нужны были бы кастомные экспшены
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }

    public function setStatus(StatusRequest $request)
    {
        try {
            $service = new ImageService();
            $data = $service->setStatus($request);
        } catch (\Exception $e) {
            throw $e;
        }

        return $data;
    }
}

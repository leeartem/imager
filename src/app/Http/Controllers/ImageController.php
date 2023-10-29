<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Image\IImageRepository;
use App\Domain\Factories\ImageSource\ImageSourceEnum;
use App\Domain\Services\Image\ImageResolver;
use App\Http\Requests\StatusRequest;

class ImageController extends Controller
{
    public function get(ImageResolver $imageResolver) {
        $dto = $imageResolver->execute(ImageSourceEnum::PICSUM->value);

        return response($dto->toArray());
    }

    public function setStatus(StatusRequest $request, IImageRepository $imageRepository)
    {
        $imageRepository->setStatus(
            null,
            $request->get('id'),
            $request->get('status'),
        );
    }
}

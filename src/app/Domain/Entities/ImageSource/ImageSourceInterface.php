<?php

namespace App\Domain\Entities\ImageSource;

use App\Domain\Services\Image\Dto\ImageDto;

/**
 * Общий интерфейс для источников картинок
 */
interface ImageSourceInterface
{
    public function getImage(): ImageDto;
}

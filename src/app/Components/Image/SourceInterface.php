<?php

namespace App\Components\Image;

/**
 * Общий интерфейс для источников картинок
 */
interface SourceInterface
{
    public function getImage();
}

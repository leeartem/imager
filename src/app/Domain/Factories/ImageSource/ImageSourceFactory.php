<?php

namespace App\Domain\Factories\ImageSource;

use App\Domain\Entities\ImageSource\Vendors\Picsum;
use App\Exceptions\ImageSource\UnsupportedSourceException;
use Illuminate\Contracts\Container\BindingResolutionException;

class ImageSourceFactory
{
    /**
     * @throws UnsupportedSourceException
     * @throws BindingResolutionException
     */
    public function buildByName(string $name): mixed
    {
        return match ($name) {
            ImageSourceEnum::PICSUM->value => app()->make(Picsum::class),
            default => throw new UnsupportedSourceException($name)
        };
    }
}

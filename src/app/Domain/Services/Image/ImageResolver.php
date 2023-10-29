<?php

namespace App\Domain\Services\Image;

use App\Domain\Entities\Image\IImageRepository;
use App\Domain\Entities\Image\Image;
use App\Domain\Entities\ImageSource\ImageSourceInterface;
use App\Domain\Factories\ImageSource\ImageSourceFactory;
use App\Domain\Services\Image\Dto\ImageDto;
use App\Exceptions\UnsupportedSourceException;
use Illuminate\Contracts\Container\BindingResolutionException;

class ImageResolver
{
    public function __construct(
        private ImageSourceFactory $imageSourceFactory,
        private IImageRepository $imageRepository
    ) {
    }

    /**
     * @throws BindingResolutionException
     * @throws UnsupportedSourceException
     */
    public function execute(string $sourceName): ImageDto
    {
        /** @var ImageSourceInterface $source */
        $source = $this->imageSourceFactory->buildByName($sourceName);
        $dto = $source->getImage();

        $image = $this->imageRepository->findImageBySourceNameAndExternalId(
            $dto->sourceName,
            $dto->externalId
        );

        if (null === $image) {
            $image = new Image();
            $image->sourceId = $dto->externalId;
            $image->sourceName = $dto->sourceName;
            $image->sourceUrl = $dto->sourceUrl;
            $this->imageRepository->save($image);
        }

        return $dto;
    }
}

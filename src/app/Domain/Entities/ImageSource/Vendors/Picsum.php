<?php

namespace App\Domain\Entities\ImageSource\Vendors;

use App\Domain\Entities\ImageSource\AbstractImageSource;
use App\Domain\Entities\ImageSource\ImageSourceInterface;
use App\Domain\Services\Image\Dto\ImageDto;

/**
 * Один из возможных источников картинок
 */
class Picsum extends AbstractImageSource implements ImageSourceInterface
{
    public const SOURCE = 'picsum';

    private const BASE_URL = 'https://picsum.photos';

    /**
     * @return ImageDto
     */
    public function getImage(): ImageDto
    {
        $url = self::BASE_URL . "/id/$this->randomid/600/400";
        if ($this->checkIfExists($url) !== true) {
            $this->setRandomId();
            return $this->getImage();
        }

        return new ImageDto(
            self::SOURCE,
            $url,
            $this->randomid
        );
    }
}

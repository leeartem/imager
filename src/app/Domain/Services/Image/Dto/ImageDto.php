<?php

namespace App\Domain\Services\Image\Dto;

readonly class ImageDto
{
    public function __construct(
        public string $sourceName,
        public string $sourceUrl,
        public string $externalId,
    ) {
    }

    public function toArray(): array
    {
        return [
            'sourceName' => $this->sourceName,
            'sourceUrl'  => $this->sourceUrl,
            'externalId' => $this->externalId,
        ];
    }
}

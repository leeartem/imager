<?php

namespace App\Domain\Entities\Image;

interface IImageRepository
{
    public function save(Image $image): Image;

    public function findImageBySourceNameAndExternalId(string $sourceName, string $externalId): ?Image;

    public function setStatus(?string $id, ?int $externalId, string $status): void;

    public function get(): array;
}

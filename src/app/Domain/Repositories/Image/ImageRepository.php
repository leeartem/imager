<?php

namespace App\Domain\Repositories\Image;

use App\Domain\Entities\Image\IImageRepository;
use App\Domain\Entities\Image\Image;
use Illuminate\Database\Eloquent\Model;

class ImageRepository implements IImageRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = new Image();
    }

    public function save(Image $image): Image
    {
        $image->save();

        return $image;
    }

    public function findImageBySourceNameAndExternalId(string $sourceName, string $externalId): ?Image
    {
        return $this->model->newQuery()
            ->where('sourceName', $sourceName)
            ->where('sourceId', $externalId)
            ->first();
    }

    public function setStatus(?string $id, ?int $externalId, string $status): void
    {
        $query = $this->model->newQuery();

        if ($id) {
            $query->where('id', $id);
        }

        if ($externalId) {
            $query->where('sourceId', $externalId);
        }

        $query->update(
                [
                    'status' => $status
                ]
            );
    }

    public function get(): array
    {
        return $this->model->newQuery()
            ->orderBy('status')
            ->get()
            ->all();
    }
}

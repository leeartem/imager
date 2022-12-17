<?php

namespace App\Components\Image;

use App\Components\Image\ImageModel;
use App\Components\Image\Picsum;
use App\Exceptions\UnsupportedSourceException;
use Illuminate\Http\Request;

class ImageService
{
    /**
     * маппинг источников, на случай, если потом их будет несколько
     */
    public const SOURCE_CLASS_MAP = [
        'picsum' => Picsum::class,
    ];

    /**
     * Резолвим класс нужного источника
     *
     * @param string $type
     * @param array $classMap
     * @return mixed
     * @throws UnsupportedSourceException
     */
    public function resolveClass(string $type, array $classMap): mixed
    {
        if (!array_key_exists($type, $classMap)) {
            throw new UnsupportedSourceException($type);
        }
        $sourceClass = $classMap[$type];

        return new $sourceClass($type);
    }

    /**
     * Запрашиваем картинку из класса источника
     * @param string $sourceName
     * @return ImageModel
     * @throws UnsupportedSourceException
     */
    public function getImage(string $sourceName): ImageModel
    {
        $source = $this->resolveClass($sourceName, self::SOURCE_CLASS_MAP);
        $data = $source->getImage();
        $image = $this->checkImage($data);
        if ($image === null) {
            return $this->getImage($sourceName);
        }

        return $image;
    }

    /**
     * Проверяем картинку
     * если уже в базе, запрашиваем другую
     * если нет в базе то сохраняем и возвращаем
     * @param array $data
     * @return ImageModel|null
     * @throws \Exception
     */
    private function checkImage(array $data): ?ImageModel
    {
        $image = ImageModel::where(['sourceName' => $data['sourceName']])
            ->where(['sourceId' => $data['sourceId']])
            ->first();

        if ($image === null) {
            $image = $this->saveImage($data);
            return $image;
        }

        return null;
    }

    /**
     * Сохраняем картинку в бд
     *
     * @param array $data
     * @return ImageModel
     * @throws \Exception
     */
    private function saveImage(array $data): ImageModel
    {
        try {
            $image = ImageModel::create($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return $image;
    }

    /**
     * Устанавливем статус картинки
     *
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function setStatus(Request $request)
    {
        $image = ImageModel::find($request->id);
        $data = [
            'status' => $request->status,
        ];
        $this->updateImage($image, $data);
    }

    /**
     * Метод на случай, если будет необходимость
     * менять не только статус, но и другие данные
     *
     * @param ImageModel $image
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    private function updateImage(ImageModel $image, array $data): bool
    {
        try {
            $image->update($data);
        } catch (\Exception $e) {
            throw $e;
        }

        return true;
    }


    /**
     * Получаем все картинки в бд
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getImages(): \Illuminate\Database\Eloquent\Collection
    {
        $data = ImageModel::orderBy('status', 'asc')->get();

        return $data;
    }
}

<?php

namespace App\Components\Image;

use Illuminate\Support\Facades\Http;

/**
 * Один из возможных источников картинок
 */
class Picsum implements SourceInterface
{
    public const SOURCE = 'picsum';

    /**
     * Метод получения картинки
     * у конкретного источника
     *
     * @return array
     */
    public function getImage(): array
    {
        $randomId = rand(0, 1020);
        $url = "https://picsum.photos/id/$randomId/600/400";
        if ($this->checkImage($url) !== true) {
            return $this->getImage();
        }

        $data = [
            'sourceName' => self::SOURCE,
            'sourceUrl' => $url,
            'sourceId' => $randomId,
        ];

        return $data;
    }

    /**
     * У меня некоторые айдишки отдавали 404,
     * так что сделал доп проверку, что ссылка не битая
     *
     * @param string $url
     * @return bool
     */
    private function checkImage(string $url): bool
    {
        $status = Http::get($url)->status();

        return $status === 200;
    }
}

<?php

namespace App\Domain\Entities\Image;

enum ImageStatusEnum: string
{
    case WAITING = 'waiting';
    case ACCEPTED = 'accepted';
    case REFUSED = 'refused';

    public static function getAll(): array
    {
        return array_column(self::cases(), 'value');
    }
}

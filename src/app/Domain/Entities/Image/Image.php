<?php

namespace App\Domain\Entities\Image;

use App\Http\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use UsesUuid;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'images';

    protected $fillable = [
        'sourceId',
        'sourceName',
        'sourceUrl',
        'status'
    ];

    public $timestamps = false;
}

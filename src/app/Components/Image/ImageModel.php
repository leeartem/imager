<?php

namespace App\Components\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;
    use \App\Http\Traits\UsesUuid;
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

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoInfo extends Model
{
    //
    protected $fillable = [
        'photo_id',
        'shooting_location',
    ];
}

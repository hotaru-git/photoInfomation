<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoInfo extends Model
{
    
    // model名とテーブル名で紐付け
    // model : PhotoInfo , tableName : photo_infos
    

    protected $fillable = [
        'photo_id',
        'shooting_location',
    ];
    // Laravelでは「id」timestampsのカラム「create_at」「update_id」が標準で作成する仕組みがあるのでfalseにする
    public $timestamps = false;
    
}

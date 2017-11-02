<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMedia extends Model
{
    protected $table = 'user_media';

    protected $fillable = [
        'media_name', 'media_path', 'user_id', 'media_type',
    ];
}

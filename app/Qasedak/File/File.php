<?php

namespace App\Qasedak\File;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'message_id', 'path',
    ];
}

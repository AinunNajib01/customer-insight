<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
	protected $table = 'TB_FILES';

    protected $fillable = [
        'title',
        'filepath'
    ];
}

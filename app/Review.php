<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $fillable = [
        'id', 'user', 'comment', 'desire'
    ];
}

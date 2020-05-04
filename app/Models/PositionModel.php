<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    protected $table = 'positions';
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];
}

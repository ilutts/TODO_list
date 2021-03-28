<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusTask extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
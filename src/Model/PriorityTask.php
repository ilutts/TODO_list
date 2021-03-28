<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PriorityTask extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
}
<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'password',
        'leader_id'
    ];

    public function task()
    {
        return $this->hasOne('App\Model\Task');
    }

    public function leader()
    {
        return $this->hasOne(User::class, 'id', 'leader_id');
    }
}
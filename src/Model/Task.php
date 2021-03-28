<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'ending_at',
        'priority_tasks_id',
        'status_tasks_id',
        'creater_id',
        'responsible_id',
    ];

    public function creater()
    {
        return $this->belongsTo('App\Model\User', 'creater_id');
    }

    public function responsible()
    {
        return $this->belongsTo('App\Model\User', 'responsible_id');
    }

    public function priority()
    {
        return $this->belongsTo('App\Model\PriorityTask', 'priority_tasks_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Model\StatusTask', 'status_tasks_id');
    }
}
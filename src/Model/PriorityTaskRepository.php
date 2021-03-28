<?php

namespace App\Model;

use \Illuminate\Database\Capsule\Manager as Capsule;

class PriorityTaskRepository
{
    public static function createTable()
    {
        if (!Capsule::schema()->hasTable('priority_tasks')) {
            Capsule::schema()->create('priority_tasks', function ($table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('description')->unique();;
                $table->timestamps();
            });
        }
    }

    public static function add(string $name, string $description)
    { 
        PriorityTask::firstOrCreate([
            'name' => $name,
            'description' => $description,
        ]);
    }
}
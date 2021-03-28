<?php

namespace App\Model;

use \Illuminate\Database\Capsule\Manager as Capsule;

class StatusTaskRepository
{
    public static function createTable()
    {
        if (!Capsule::schema()->hasTable('status_tasks')) {
            Capsule::schema()->create('status_tasks', function ($table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('description')->unique();;
                $table->timestamps();
            });
        }
    }

    public static function add(string $name, string $description)
    { 
        StatusTask::firstOrCreate([
            'name' => $name,
            'description' => $description,
        ]);
    }
}
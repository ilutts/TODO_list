<?php

namespace App\Model;

use \Illuminate\Database\Capsule\Manager as Capsule;

class TaskRepository
{
    public static function createTable()
    {
        if (!Capsule::schema()->hasTable('tasks')) {
            Capsule::schema()->create('tasks', function ($table) {
                $table->increments('id');
                $table->string('title');
                $table->longText('description');
                $table->date('ending_at');
                $table->timestamps();
                
                $table->integer('priority_tasks_id')->unsigned();
                $table->foreign('priority_tasks_id')->references('id')->on('priority_tasks');

                $table->integer('status_tasks_id')->unsigned();
                $table->foreign('status_tasks_id')->references('id')->on('status_tasks');
                
                $table->integer('creater_id')->unsigned();
                $table->foreign('creater_id')->references('id')->on('users');

                $table->integer('responsible_id')->unsigned();
                $table->foreign('responsible_id')->references('id')->on('users');
            });

        }
    }

    public static function add(string $title, string $description, string $endingAt, int $priority, int $status, int $creater, int $responsible)
    { 
        Task::firstOrCreate([
            'title' => $title,
            'description' => $description,
            'ending_at' => $endingAt,
            'priority_tasks_id' => $priority,
            'status_tasks_id' => $status,
            'creater_id' => $creater,
            'responsible_id' => $responsible,
        ]);
    }

    public static function change(int $id, array $data)
    {
        return Task::where('id', '=', $id)->update($data);
    }
}
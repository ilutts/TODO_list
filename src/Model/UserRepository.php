<?php

namespace App\Model;

use \Illuminate\Database\Capsule\Manager as Capsule;

class UserRepository
{
    public static function createTable()
    {
        if (!Capsule::schema()->hasTable('users')) {
            Capsule::schema()->create('users', function ($table) {
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->string('patronymic')->nullable();
                $table->string('login')->unique();
                $table->string('password');
                $table->integer('leader_id')->unsigned();
                $table->timestamps();

                $table->foreign('leader_id')->references('id')->on('users');
            });
        }
    }

    public static function add(
        string $name,
        string $surname,
        string $patronymic = '',
        string $login,
        string $password,
        int $leader
    )
    {
        return User::firstOrCreate([
            'name' => $name,
            'surname' => $surname,
            'patronymic' => $patronymic,
            'login' => $login,
            'password' => $password,
            'leader_id' => $leader,
        ]);
    }
}
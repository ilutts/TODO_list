<?php

namespace App\Service;

use App\Model\PriorityTaskRepository;
use App\Model\StatusTaskRepository;
use App\Model\TaskRepository;
use App\Model\UserRepository;

class SetupServices
{
    public static function installDB()
    {
        self::addPriorityTask();
        self::addStatusTask();
        self::addUser();
        self::addTask();
    }

    private static function addTask()
    {
        TaskRepository::createTable();
        TaskRepository::add('task 1', 'super task', '2022-05-10', 1, 1, 1, 2);
        TaskRepository::add('task 2', 'super task super', '2022-06-10', 2, 2, 1, 1);
        TaskRepository::add('task 3', 'super task super 3', '2022-07-10', 1, 1, 4, 5);
    }

    private static function addUser()
    {
        UserRepository::createTable();
        UserRepository::add('Ivan', 'Ivanov', 'Ivanovich', 'ivanov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 1);
        UserRepository::add('Test', 'Testov', 'Testovich', 'testov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 1);
        UserRepository::add('Petr', 'Petrov', 'Petrovich', 'petrov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 1);

        UserRepository::add('Дмитрий', 'Дмитров', 'Дмитрович', 'dmitrov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 2);
        UserRepository::add('Олег', 'Олегов', 'Олегович', 'olegov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 4);
        UserRepository::add('Евгений', 'Евгенов', 'Евгенович', 'evgenov', '$2y$10$2cOF4UeI.HIqyvDbiuCe8eNd5NPEfUswns0m5KkzbkBfLcEhOz3sG', 4);
    }
    
    private static function addPriorityTask()
    {
        PriorityTaskRepository::createTable();
        PriorityTaskRepository::add('high', 'Высокий');
        PriorityTaskRepository::add('middle', 'Средний');
        PriorityTaskRepository::add('low', 'Низкий');
    }

    private static function addStatusTask()
    {
        StatusTaskRepository::createTable();
        StatusTaskRepository::add('to_implementation', 'К выполнению');
        StatusTaskRepository::add('performed', 'Выполняется');
        StatusTaskRepository::add('completed', 'Выполнена');
        StatusTaskRepository::add('canceled', 'Отменена');
    }
}
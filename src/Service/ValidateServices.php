<?php

namespace App\Service;

use App\Model\User;

class ValidateServices
{
    private array $error = [];

    public function getError()
    {
        return $this->error;
    }

    public function title(string $title): bool
    {
        if (mb_strlen($title) < 3) {
            $this->error['title'] = 'Неправильно заполнен заголовок';
            return false;
        }

        return true;
    }

    public function description(string $description): bool
    {
        if (mb_strlen($description) < 3) {
            $this->error['description'] = 'Неправильно заполнено описание';
            return false;
        }

        return true;
    }

    public function endingAt(string $date): bool
    {
        if (!strtotime($date)) {
            $this->error['date'] = 'Неправильный формат даты';
            return false;
        }

        // Проверка на создание задания из прошлого :) - Отключена

        /* if (strtotime($date) < strtotime(date('Y-m-d'))) {
            $this->error['date'] = 'Указанная дата меньше текущей!';
            return false;
        }*/

        return true;
    }

    public function responsible(int $userId, int $responsibleId): bool
    {
        if ($userId === $responsibleId) {
            return true;
        }
        
        $user = User::where('id', $responsibleId)->where('leader_id', $userId)->first();

        if (!$user) {
            $this->error['responsible'] = 'Указанный пользователь не в подчинение';
            return false;
        }

        return true;
    }

}
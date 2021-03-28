<?php

namespace App\Controller;

use App\Service\Authorization;
use App\Service\TaskServices;
use App\View\View;

class Controller 
{
    public function mainView(): View
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $auth = new Authorization($_POST['login'], $_POST['password']);
            $auth->login();
        }

        return empty($_SESSION['isAuth']) ? $this->loginView() : $this->taskView();
    }

    public function loginView(): View
    {
        return new View('login');
    }

    public function taskView(): View
    {
        $tasks = new TaskServices((int)$_SESSION['user']['id']);
        
        if (isset($_POST['btn_popup'])) {
            
            if ($_POST['btn_popup'] === 'new') {
                $tasks->new();
            }

            if ($_POST['btn_popup'] === 'change') {
                $tasks->change();
            }
        }

        $data = $tasks->get();

        return new View('tasks', $data);
    }
}
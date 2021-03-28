<?php

namespace App\Service;

use App\Model\PriorityTask;
use App\Model\StatusTask;
use App\Model\Task;
use App\Model\TaskRepository;
use App\Model\User;

class TaskServices
{
    private int $userId;

    private int $id;
    private string $title;
    private string $description;
    private string $endingAt;
    private int $priorityId;
    private int $statusId;
    private int $responsibleId;

    private array $validateError = [];

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function get()
    {
        $tasks = Task::where('creater_id', $this->userId)->orWhere('responsible_id', $this->userId)->get();
        
        $tasks = $this->sort($tasks);

        $tasks->users = User::where('leader_id', $this->userId)->get();
        $tasks->prioritys = PriorityTask::all();
        $tasks->statuses = StatusTask::all();

        if ($this->validateError) {
            $tasks->error = $this->validateError; 
        }

        return $tasks;
    }

    private function setData()
    {
        $this->id = intval($_POST['id'] ?? 0);
        $this->title = htmlspecialchars($_POST['title'] ?? '');
        $this->description = htmlspecialchars($_POST['description'] ?? '');
        $this->endingAt = htmlspecialchars($_POST['date'] ?? '');
        $this->priorityId = intval($_POST['priority'] ?? 0);
        $this->statusId = intval($_POST['status'] ?? 0);
        $this->responsibleId = intval($_POST['responsible'] ?? 0);
        $this->createrId = intval($_POST['creater'] ?? 0);
        $this->btnPopup = htmlspecialchars($_POST['btn_popup'] ?? '');
    }

    public function new()
    {
        $this->setData();

        if ($this->btnPopup === 'new' && $this->validate()) {
            TaskRepository::add(
                $this->title, 
                $this->description, 
                $this->endingAt,
                $this->priorityId,
                $this->statusId, 
                $this->userId, 
                $this->responsibleId
            );
        }
    }
    
    public function change()
    {
        $this->setData();

        if ($this->btnPopup === 'change' && $this->id) {
            if ($this->createrId === $this->userId && $this->validate()) {
                $update = [
                    'title' => $this->title,
                    'description' => $this->description,
                    'ending_at' => $this->endingAt,
                    'priority_tasks_id' => $this->priorityId,
                    'status_tasks_id' => $this->statusId,
                    'responsible_id' => $this->responsibleId
                ];
            } else {
                $update = ['status_tasks_id' => $this->statusId];
            }

            TaskRepository::change($this->id, $update);
        }
    }

    private function validate(): bool
    {
        $validateService = new ValidateServices();

        $validateService->title($this->title);
        $validateService->description($this->description);
        $validateService->endingAt($this->endingAt);
        $validateService->responsible($this->userId, $this->responsibleId);

        $this->validateError = $validateService->getError();
        
        return $this->validateError ? false : true;
    }

    private function sort($tasks)
    {
        if (!empty($_GET['date'])) {
            switch (htmlspecialchars($_GET['date'])) {
                case 'today':
                    $tasks = $tasks->where('ending_at', date('Y-m-d'));
                    break;
                
                case 'week':
                    $tasks = $tasks->where('ending_at', '>=', date('Y-m-d'))->where('ending_at', '<=', date('Y-m-d', strtotime('+7 days')));
                    break;
                
                case 'future':
                    $tasks = $tasks->where('ending_at', '>', date('Y-m-d', strtotime('+7 days')));
                    break;
            }
        }

        if (!empty($_GET['responsible'])) {
            $responsible = (int)$_GET['responsible'];

            $tasks = $tasks->where('creater_id', $this->userId)->where('responsible_id', $responsible);
        }

        return $tasks->sortByDesc('updated_at');
    }
}
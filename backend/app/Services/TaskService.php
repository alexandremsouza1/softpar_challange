<?php

namespace App\Services;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\TaskAssignee;

class TaskService {

    private Task $task;
    private Subtask $subtask;

    public function __construct(Task $task, Subtask $subtask)
    {
        $this->task = $task;
        $this->subtask = $subtask;
    }
    
    public function createTask(array $data, $user)
    {
        $task = $this->task->create($data); 
        $task->assignees()->create([
            'user_id' => $user->id,
            'assignee_type' => Task::class,
            'assignee_id' => $task->id,
        ]);
        foreach ($data['subtasks'] as $subtask) {
            $findTask = $this->task->find($subtask['id']);
            $subTask = $this->subtask->create([
                'task_id' => $findTask->id,
                'title' => $subtask['label'],
                'is_completed' => $findTask->is_completed,
            ]);
            $this->createSubtask($subTask, $user);
        }
    
        return $task;
    }

    private function createSubtask($task, $user)
    {
        $task->assignees()->create([
            'user_id' => $user->id,
            'assignee_type' => Subtask::class,
            'assignee_id' => $task->id,
        ]);
    }

    public function getTasks()
    {
        return $this->task->with('category')->get();
    }

    public function updateTask(array $data, $id)
    {
        $task = $this->task->find($id);
        $task->update($data);
        return $task;
    }

}
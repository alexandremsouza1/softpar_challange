<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Task;
use Illuminate\Http\Request;

class UserAchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Busca todas as conquistas
        $achievements = Achievement::all();

        // Busca todas as tarefas completas
        $completedTasks = Task::where('is_completed', true)
            ->get();

        $completedAchievements = [];

        foreach ($achievements as $achievement) {
            $isCompleted = false;

            // Verifica condições baseadas em task_count
            if ($achievement->task_count !== null) {
                $isCompleted = $completedTasks->count() >= $achievement->task_count;
            }

            // Verifica condição de time_limit
            if (!$isCompleted && $achievement->time_limit !== null) {
                $isCompleted = $completedTasks->some(function ($task) use ($achievement) {
                    $taskCreatedAt = strtotime($task->created_at);
                    $timeLimit = $achievement->time_limit * 60;
                    return time() - $taskCreatedAt <= $timeLimit;
                });
            }

            // Verifica condição de weekly_task_count
            if (!$isCompleted && $achievement->weekly_task_count !== null) {
                $weeklyTasks = $completedTasks->filter(function ($task) {
                    return now()->subWeek() <= $task->created_at;
                });
                $isCompleted = $weeklyTasks->count() >= $achievement->weekly_task_count;
            }

            // Adiciona a conquista aos completados, se aplicável
            if ($isCompleted) {
                $completedAchievements[] = $achievement;
            }
        }

        return response()->json([
            'completed_achievements' => $completedAchievements,
            'total_completed' => count($completedAchievements),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

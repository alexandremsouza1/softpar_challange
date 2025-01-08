<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('achievements')->insert([
            [
                'name' => 'Produtividade Extrema',
                'description' => 'Conclua 100 tarefas.',
                'points' => 100,
                'task_count' => 100,
                'time_limit' => null,
                'weekly_task_count' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Concluidor de Tarefas',
                'description' => 'Conclua 10 tarefas.',
                'points' => 20,
                'task_count' => 10,
                'time_limit' => null,
                'weekly_task_count' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desbloqueio Rápido',
                'description' => 'Complete uma tarefa dentro de 1 hora após criação.',
                'points' => 50,
                'task_count' => 1,
                'time_limit' => 60, // 1 hour in minutes
                'weekly_task_count' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Semanas Produtivas',
                'description' => 'Conclua 20 tarefas em uma semana.',
                'points' => 150,
                'task_count' => null,
                'time_limit' => null,
                'weekly_task_count' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Começando Bem',
                'description' => 'Complete sua primeira tarefa.',
                'points' => 10,
                'task_count' => 1,
                'time_limit' => null,
                'weekly_task_count' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Concluidor de Tarefas',
                'description' => 'Conclua 10 tarefas.',
                'points' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desbloqueio Rápido',
                'description' => 'Complete uma tarefa dentro de 1 hora após criação.',
                'points' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Semanas Produtivas',
                'description' => 'Conclua 20 tarefas em uma semana.',
                'points' => 150,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Começando Bem',
                'description' => 'Complete sua primeira tarefa.',
                'points' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

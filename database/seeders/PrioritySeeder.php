<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Priority;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $priorities = [
            [
                'name'          => 'Baixa',
                'description'   => 'Prioridade baixa'
            ],
            [
                'name'          => 'Média',
                'description'   => 'Prioridade média'
            ],
            [
                'name'          => 'Alta',
                'description'   => 'Prioridade alta'
            ],
            [
                'name'          => 'Urgente',
                'description'   => 'Prioridade urgente'
            ],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}

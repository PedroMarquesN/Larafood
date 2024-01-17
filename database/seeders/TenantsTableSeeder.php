<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj' => '2635597546465',
            'name' => 'EspecializaTI',
            'url' => 'especializati',
            'email' => 'pedroleagueartmarques@gmail.com'
        ]);
    }
}

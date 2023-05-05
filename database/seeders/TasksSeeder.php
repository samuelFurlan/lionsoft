<?php

namespace Database\Seeders;

use App\Models\Tasks;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($user_id)
    {
       Tasks::factory(10)->create(['user_id' => $user_id]);
    }
}

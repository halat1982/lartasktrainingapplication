<?php

use Illuminate\Database\Seeder;

class TaskStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ts = [
            [
                'title' => 'Не начата'
            ],
            [
                'title' => 'В процессе'
            ],
            [
                'title' => 'Завершена'
            ],
            [
                'title' => 'Отложена'
            ],

        ];
        DB::table('task_statuses')->insert($ts);
    }
}

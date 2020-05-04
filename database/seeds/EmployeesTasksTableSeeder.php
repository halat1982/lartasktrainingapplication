<?php

use Illuminate\Database\Seeder;

class EmployeesTasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $et = [
            [
                'employee_id' => 1,
                'task_id' => 1
            ],
            [
                'employee_id' => 1,
                'task_id' => 2
            ],
            [
                'employee_id' => 2,
                'task_id' => 3
            ],
            [
                'employee_id' => 3,
                'task_id' => 13
            ],
            [
                'employee_id' => 4,
                'task_id' => 13
            ],
            [
                'employee_id' => 5,
                'task_id' => 10
            ],
            [
                'employee_id' => 8,
                'task_id' => 9
            ],
            [
                'employee_id' => 8,
                'task_id' => 3
            ],
            [
                'employee_id' => 3,
                'task_id' => 3
            ],
            [
                'employee_id' => 6,
                'task_id' => 6
            ],
            [
                'employee_id' => 7,
                'task_id' => 7
            ],
            [
                'employee_id' => 8,
                'task_id' => 8
            ],
            [
                'employee_id' => 8,
                'task_id' => 11
            ],
            [
                'employee_id' => 6,
                'task_id' => 4
            ],
            [
                'employee_id' => 6,
                'task_id' => 3
            ],
            [
                'employee_id' => 1,
                'task_id' => 3
            ],
            [
                'employee_id' => 4,
                'task_id' => 12
            ],
            [
                'employee_id' => 8,
                'task_id' => 13
            ]
        ];

        DB::table('employees_tasks')->insert($et);
    }
}

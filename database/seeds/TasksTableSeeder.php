<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = [
            [
                'project_id' => 1,
                'reg_num' => 'TSK1-1',
                'title' => 'TSK1-1 Title Task',
                'description' => 'TSK1-1 Task description',
                'start_date' => '2020-03-18 00:00:00',
                'finish_date' => null,
                'rate_time' => 15,
                'status' => 1
            ],
            [
                'project_id' => 1,
                'reg_num' => 'TSK2-1',
                'title' => 'TSK2-1 Title Task',
                'description' => 'TSK2-1 Task description',
                'start_date' => '2015-09-09 00:00:00',
                'finish_date' => '2015-09-12 00:00:00',
                'rate_time' => 30,
                'status' => 3
            ],
            [
                'project_id' => 1,
                'reg_num' => 'TSK3-1',
                'title' => 'TSK3-1 Title Task',
                'description' => 'TSK3-1 Task description',
                'start_date' => '2020-03-18 00:00:00',
                'finish_date' => null,
                'rate_time' => 6,
                'status' => 4
            ],
            [
                'project_id' => 1,
                'reg_num' => 'TSK4-1',
                'title' => 'TSK4-1 Title Task',
                'description' => 'TSK4-1 Task description',
                'start_date' => '2017-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 6,
                'status' => 4
            ],
            [
                'project_id' => 1,
                'reg_num' => 'TSK5-1',
                'title' => 'TSK5-1 Title Task',
                'description' => 'TSK5-1 Task description',
                'start_date' => '2016-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 2,
                'status' => 1
            ],
            [
                'project_id' => 1,
                'reg_num' => 'TSK6-1',
                'title' => 'TSK6-1 Title Task',
                'description' => 'TSK6-1 Task description',
                'start_date' => '2011-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 15,
                'status' => 2
            ],
            [
                'project_id' => 2,
                'reg_num' => 'TSK1-2',
                'title' => 'TSK1-2 Title Task',
                'description' => 'TSK1-2 Task description',
                'start_date' => '2013-09-09 00:00:00',
                'finish_date' => '2016-09-09 00:00:00',
                'rate_time' => 17,
                'status' => 3
            ],
            [
                'project_id' => 2,
                'reg_num' => 'TSK2-2',
                'title' => 'TSK2-2 Title Task',
                'description' => 'TSK2-2 Task description',
                'start_date' => '2015-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 8,
                'status' => 4
            ],
            [
                'project_id' => 2,
                'reg_num' => 'TSK3-2',
                'title' => 'TSK3-2 Title Task',
                'description' => 'TSK3-2 Task description',
                'start_date' => '2020-04-04 00:00:00',
                'finish_date' => null,
                'rate_time' => 5,
                'status' => 1
            ],
            [
                'project_id' => 2,
                'reg_num' => 'TSK4-2',
                'title' => 'TSK4-2 Title Task',
                'description' => 'TSK4-2 Task description',
                'start_date' => '2019-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 14,
                'status' => 2
            ],
            [
                'project_id' => 2,
                'reg_num' => 'TSK5-2',
                'title' => 'TSK5-2 Title Task',
                'description' => 'TSK5-2 Task description',
                'start_date' => '2011-09-09 00:00:00',
                'finish_date' => '2012-09-09 00:00:00',
                'rate_time' => 12,
                'status' => 3
            ],
            [
                'project_id' => 3,
                'reg_num' => 'TSK1-3',
                'title' => 'TSK1-3 Title Task',
                'description' => 'TSK1-3 Task description',
                'start_date' => '2015-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 10,
                'status' => 4
            ],
            [
                'project_id' => 3,
                'reg_num' => 'TSK2-3',
                'title' => 'TSK2-3 Title Task',
                'description' => 'TSK2-3 Task description',
                'start_date' => '2015-09-09 00:00:00',
                'finish_date' => null,
                'rate_time' => 20,
                'status' => 1
            ],
        ];
        DB::table('tasks')->insert($tasks);
    }
}

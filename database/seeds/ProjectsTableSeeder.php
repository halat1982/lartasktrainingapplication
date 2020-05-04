<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = [
            [
                'reg_num' => 'PR1',
                'title' => 'PR1 Title Project',
                'alias' => 'Project 1',
                'description' => 'Project 1 description',
                'manager_id' => 4,
                'register_date' => '2012-12-12'
            ],
            [
                'reg_num' => 'PR2',
                'title' => 'PR2 Title Project',
                'alias' => 'Project 2',
                'description' => 'Project 2 description',
                'manager_id' => 2,
                'register_date' => '2012-12-15'
            ],
            [
                'reg_num' => 'PR3',
                'title' => 'PR3 Title Project',
                'alias' => 'Project3',
                'description' => 'Project 3 description',
                'manager_id' => 1,
                'register_date' => '2012-12-18'
            ]
        ];

        DB::table('projects')->insert($projects);
    }
}



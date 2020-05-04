<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            [
                'title' => 'Ген. директор'

            ],
            [
                'title' => 'Управляющий'

            ],
            [
                'title' => 'Менеджер'

            ],
            [
                'title' => 'Инженер-программист'

            ],
            [
                'title' => 'Программист'

            ],
            [
                'title' => 'Внешний пользователь'

            ]
        ];
        DB::table('positions')->insert($positions);
    }
}

<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
                'reg_num' => 'EM1',
                'last_name' => 'Гаевский',
                'first_name' => 'Михаил',
                'second_name' => 'Васильевич',
                'position' => 2,
                'birthday_date' => '1987-03-05 00:00:00',
                'email' => 'gay@company.com',
                'phone' => '35-87-22'
            ],
            [
                'reg_num' => 'EM2',
                'last_name' => 'Каверин',
                'first_name' => 'Андрей',
                'second_name' => 'Дмитриевич',
                'position' => 3,
                'birthday_date' => '1991-03-05 00:00:00',
                'email' => 'kav@company.com',
                'phone' => '35-87-23'
            ],
            [
                'reg_num' => 'EM3',
                'last_name' => 'Волошин',
                'first_name' => 'Геннадий',
                'second_name' => 'Ильич',
                'position' => 1,
                'birthday_date' => '1965-03-05 00:00:00',
                'email' => 'vol@company.com',
                'phone' => '35-87-24'
            ],
            [
                'reg_num' => 'EM4',
                'last_name' => 'Бекешев',
                'first_name' => 'Виталий',
                'second_name' => 'Георгиевич',
                'position' => 6,
                'birthday_date' => '1982-03-05 00:00:00',
                'email' => 'bek@company.com',
                'phone' => '35-87-25'
            ],
            [
                'reg_num' => 'EM5',
                'last_name' => 'Леонов',
                'first_name' => 'Кондрат',
                'second_name' => 'Мамедович',
                'position' => 5,
                'birthday_date' => '1995-03-05 00:00:00',
                'email' => 'leo@company.com',
                'phone' => '35-87-26'
            ],
            [
                'reg_num' => 'EM6',
                'last_name' => 'Веселов',
                'first_name' => 'Илья',
                'second_name' => 'Михайлович',
                'position' => 4,
                'birthday_date' => '1994-06-06 00:00:00',
                'email' => 'ves@company.com',
                'phone' => '35-87-27'
            ],
            [
                'reg_num' => 'EM7',
                'last_name' => 'Чирак',
                'first_name' => 'Василий',
                'second_name' => 'Петрович',
                'position' => 3,
                'birthday_date' => '1995-03-05 00:00:00',
                'email' => 'chi@company.com',
                'phone' => '35-87-28'
            ],
            [
                'reg_num' => 'EM8',
                'last_name' => 'Колбасов',
                'first_name' => 'Роман',
                'second_name' => 'Семенович',
                'position' => 3,
                'birthday_date' => '1991-03-05 00:00:00',
                'email' => 'col@company.com',
                'phone' => '35-87-29'
            ],
        ];
        DB::table('employees')->insert($employees);
    }
}

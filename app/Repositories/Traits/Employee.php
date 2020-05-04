<?php


namespace App\Repositories\Traits;

use Illuminate\Support\Facades\DB;

trait Employee
{
    public function getEmployeesList()
    {
        $employeesList = DB::table('employees')->select('id', 'last_name', 'first_name', 'second_name')->get();
        return $employeesList;
    }
}

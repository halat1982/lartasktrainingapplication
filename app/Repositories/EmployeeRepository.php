<?php


namespace App\Repositories;

use App\Helpers\BaseHelper;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeModel as Model;

class EmployeeRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($request)
    {
        $order = 'employees.id';

        if ($request->sort) {
            $order = $request->sort;
        }

        $res = $this->startConditions()->
        leftJoin('employees_tasks', 'employees.id', '=', 'employees_tasks.employee_id')->
        join('positions', 'employees.position', '=', 'positions.id')->
        select(
            DB::raw('COUNT(DISTINCT employees_tasks.id) as count_of_tasks'),
            DB::raw('TIMESTAMPDIFF(YEAR,employees.birthday_date,CURDATE()) as ages'),
            'employees.*',
            'positions.title as position_title'
        )->
        groupBy('employees.id')->
        orderBy($order)->
        paginate();

        return $res;
    }

    public function getSearchResult($str)
    {
        $res = $this->startConditions()->
        leftJoin('employees_tasks', 'employees.id', '=', 'employees_tasks.employee_id')->
        join('positions', 'employees.position', '=', 'positions.id')->
        select(
            DB::raw('COUNT(DISTINCT employees_tasks.id) as count_of_tasks'),
            DB::raw('TIMESTAMPDIFF(YEAR,employees.birthday_date,CURDATE()) as ages'),
            'employees.*',
            'positions.title as position_title'
        )->
        where('employees.last_name', 'like', '%' . $str . '%')->
        orWhere('employees.first_name', 'like', '%' . $str . '%')->
        orWhere('employees.second_name', 'like', '%' . $str . '%')->
        orWhere('employees.phone', 'like', '%' . $str . '%')->
        orWhere('positions.title', 'like', '%' . $str . '%')->
        groupBy('employees.id')->
        get();

        return $res;
    }

    public function getPositionsList()
    {
        return DB::table('positions')->select('id', 'title')->get();
    }

    public function createEmployee($request)
    {
        $data = $request->input();
        $data['reg_num'] = BaseHelper::generateID("EM", 5);
        $item = new Model($data);
        $res = $item->save();

        return $res;
    }

}

<?php


namespace App\Repositories;

use App\Models\ProjectsModel as Model;
use App\Repositories\Traits\Employee;
use Illuminate\Support\Facades\DB;

class ProjectRepository extends CoreRepository
{
    use Employee;

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($request)
    {
        $order = 'projects.id';

        if ($request->sort) {
            $order = $request->sort;
        }

        $res = $this->startConditions()->
        leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')->
        leftJoin('employees_tasks', 'tasks.id', '=', 'employees_tasks.id')->
        select(
            DB::raw('count(employees_tasks.task_id) as task_count'),
            'projects.*'
        )->
        with('employee:id,last_name,first_name,second_name')->
        groupBy('projects.id')->
        orderBy($order)->
        paginate();
        return $res;
    }

    public function getSearchResult($str)
    {
        $res = $this->startConditions()->
        leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')->
        leftJoin('employees_tasks', 'tasks.id', '=', 'employees_tasks.id')->
        select(
            DB::raw('count(employees_tasks.task_id) as task_count'),
            'projects.*'
        )->
        with('employee:id,last_name,first_name,second_name')->
        where('projects.title', 'like', '%' . $str . '%')->
        orWhere('projects.alias', 'like', '%' . $str . '%')->
        orWhere('projects.description', 'like', '%' . $str . '%')->
        orWhere('employees.last_name', 'like', '%' . $str . '%')->
        orWhere('employees.first_name', 'like', '%' . $str . '%')->
        orWhere('employees.second_name', 'like', '%' . $str . '%')->
        groupBy('projects.id')->get();

        return $res;
    }
}

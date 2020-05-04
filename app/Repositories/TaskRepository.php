<?php

namespace App\Repositories;

use App\Helpers\BaseHelper;
use App\Repositories\Traits\Employee;
use Illuminate\Support\Facades\DB;
use App\Models\TaskModel as Model;

class TaskRepository extends CoreRepository
{
    use Employee;

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($request)
    {
        $order = 'tasks.id';

        if ($request->sort) {
            $order = $request->sort;
        }

        $res = $this->startConditions()->
        leftJoin('employees_tasks', 'tasks.id', '=', 'employees_tasks.task_id')->
        leftJoin('employees', 'employees_tasks.employee_id', '=', 'employees.id')->
        leftJoin('projects', 'tasks.project_id', '=', 'projects.id')->
        leftJoin('task_statuses', 'tasks.status', '=', 'task_statuses.id')->
        select(
            DB::raw('DifHours(tasks.finish_date, tasks.start_date, tasks.rate_time) as dh'),
            'tasks.*',
            'employees.last_name',
            'employees.first_name',
            'employees.second_name',
            'task_statuses.title as stat',
            'projects.alias'
        )->
        orderBy($order)->
        paginate();

        return $res;
    }

    public function getSearchResult($str)
    {
        $res = $this->startConditions()->
        leftJoin('employees_tasks', 'tasks.id', '=', 'employees_tasks.task_id')->
        leftJoin('employees', 'employees_tasks.employee_id', '=', 'employees.id')->
        leftJoin('projects', 'tasks.project_id', '=', 'projects.id')->
        leftJoin('task_statuses', 'tasks.status', '=', 'task_statuses.id')->
        select(
            DB::raw('DifHours(tasks.finish_date, tasks.start_date, tasks.rate_time) as dh'),
            'tasks.*',
            'employees.last_name',
            'employees.first_name',
            'employees.second_name',
            'task_statuses.title as stat',
            'projects.alias'
        )->
        where('projects.alias', 'like', '%' . $str . '%')->
        orWhere('tasks.title', 'like', '%' . $str . '%')->
        orWhere('employees.last_name', 'like', '%' . $str . '%')->
        orWhere('employees.first_name', 'like', '%' . $str . '%')->
        orWhere('employees.second_name', 'like', '%' . $str . '%')
            ->get();

        return $res;
    }

    public function createTask($request)
    {
        $data = $request->input();
        $data['reg_num'] = BaseHelper::generateID("TSK", 5);
        if ($data['status'] == 3) {
            $data['finish_date'] = date("Y-m-d");
        }

        $item = new Model($data);
        $item->save();
        $tID = $item->id;
        if ($item->id) {
            foreach ($data['employee_id'] as $eid) {
                $toDB['employee_id'] = $eid;
                $toDB['task_id'] = $tID;
                DB::table('employees_tasks')->insert($toDB);
            }
            return true;
        }
        return false;
    }

    public function updateTask($request, $ts)
    {
        $data = $request->input();
        $flag = true;
        if ($data['status'] == 3) {
            $data['finish_date'] = date("Y-m-d");
        }
        //TODO: need delete from many to many relationship (pivot)
        $result = $ts->fill($data)->save();

        $tsIDs = DB::table('employees_tasks')->select('id')->where('task_id', '=', $ts->id)->get();
        foreach ($tsIDs as $id) {
            DB::table('employees_tasks')->where('task_id', '=', $ts->id)->delete();
        }
        if (isset($data['employee_id'])) {
            foreach ($data['employee_id'] as $eID) {
                DB::table('employees_tasks')->insert(['employee_id' => $eID, 'task_id' => $ts->id]);
            }
        }

        return $result;
    }

    public function getEmployeesIDsForTask($tID)
    {
        $res = DB::table('employees_tasks')->select('employee_id')->where('task_id', '=', $tID)->get();
        //don't need collection for additional logic
        $tmp = array();
        foreach ($res as $r) {
            $tmp[] = $r->employee_id;
        }
        return $tmp;
    }

    public function getStatusesList()
    {
        $statuses = DB::table('task_statuses')->select('id', 'title')->get();
        return $statuses;
    }

    public function getProjectsList()
    {
        return DB::table('projects')->select('id', 'alias')->get();
    }
}

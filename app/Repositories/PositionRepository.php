<?php


namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\PositionModel as Model;

class PositionRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate($request)
    {
        $order = 'positions.id';

        if ($request->sort) {
            $order = $request->sort;
        }

        $res = $this->startConditions()->
        leftJoin('employees', 'positions.id', '=', 'employees.position')->
        select(
            DB::raw('COUNT(DISTINCT employees.id) as emcount'),
            'positions.*'
        )->
        groupBy('positions.id')->
        orderBy($order)->
        paginate();

        return $res;
    }

    public function getSearchResult($str)
    {
        $res = $this->startConditions()->
        leftJoin('employees', 'positions.id', '=', 'employees.position')->
        select(
            DB::raw('COUNT(DISTINCT employees.id) as emcount'),
            'positions.*'
        )->
        where('positions.title', 'like', '%' . $str . '%')->
        groupBy('positions.id')->
        get();

        return $res;
    }

    public function createPosition($request)
    {
        $data = $request->input();


        $item = new Model($data);
        $res = $item->save();

        return $res;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StatisticRepository;

class StatisticController extends Controller
{
    public function index(Request $request)
    {
        $res = StatisticRepository::getAll($request);

        return view('statistics.index', compact('res'));
    }

    public function csv()
    {
        $statRep = new StatisticRepository();

        return $statRep->csv();
    }
}

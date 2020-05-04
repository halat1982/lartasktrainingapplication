<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BaseHelper;
use App\Models\EmployeeModel as Employee;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Repositories\EmployeeRepository;

class EmployeeController extends Controller
{

    private $emplRepository;

    public function __construct()
    {
        $this->emplRepository = app(EmployeeRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $res = $this->emplRepository->getSearchResult($request->search);
            return view('employees.index', compact('res'));
        }

        $res = $this->emplRepository->getAllWithPaginate($request);


        return view('employees.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Employee();
        $positionsList = $this->emplRepository->getPositionsList();

        return view('employees.create', compact('item', 'positionsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\EmployeeCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        $success = $this->emplRepository->createEmployee($request);

        if ($success) {
            return redirect()->route('employees.index')
                ->with(['success' => 'Save complete successfully']);
        } else {
            return back()->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empl = $this->emplRepository->getEdit($id);
        if ($empl) {
            $positionsList = $this->emplRepository->getPositionsList();
            return view("employees.edit", compact("empl", "positionsList"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $em = $this->emplRepository->getEdit($id);
        if (empty($em)) {
            return back()
                ->withErrors(['msg' => "id=[{$id}] not found"])
                ->withInput();
        }
        $data = $request->input();
        $result = $em->fill($data)->save();
        if ($result) {
            return back()->with('success', 'update succesfully')->withInput();
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $em = $this->emplRepository->getEdit($id);;
        $em->delete();
        if ($em) {
            return redirect()->route('employees.index')
                ->with(['success' => 'Delete complete successfully']);
        }
    }
}

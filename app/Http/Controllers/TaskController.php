<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BaseHelper;
use App\Models\TaskModel as Task;
use App\Http\Requests\TaskCreateRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{

    private $taskRepository;

    public function __construct()
    {
        $this->taskRepository = app(TaskRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $res = $this->taskRepository->getSearchResult($request->search);
            return view('tasks.index', compact('res'));
        }

        $res = $this->taskRepository->getAllWithPaginate($request);


        return view('tasks.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Task();
        $employeesList = $this->taskRepository->getEmployeesList();
        $projectsList = $this->taskRepository->getProjectsList();
        $statusesList = $this->taskRepository->getStatusesList();
        return view('tasks.create', compact('item', 'employeesList', 'projectsList', 'statusesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request)
    {
        $success = $this->taskRepository->createTask($request);

        if ($success) {
            return redirect()->route('tasks.index')
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
        $task = $this->taskRepository->getEdit($id);
        if ($task) {
            $employeesList = $employeesList = $this->taskRepository->getEmployeesList();
            $projectsList = $this->taskRepository->getProjectsList();
            $statusesList = $this->taskRepository->getStatusesList();
            $emplIDs = $this->taskRepository->getEmployeesIDsForTask($id);
            return view("tasks.edit", compact("task", "employeesList", "projectsList", "statusesList", "emplIDs"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\TaskUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $ts = $this->taskRepository->getEdit($id);
        if (empty($ts)) {
            return back()
                ->withErrors(['msg' => "id=[{$id}] not found"])
                ->withInput();
        }


        $result = $this->taskRepository->updateTask($request, $ts);

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
        $task = $this->taskRepository->getEdit($id);;
        $r = $task->delete();
        if ($r) {
            return redirect()->route('tasks.index')
                ->with(['success' => 'Delete complete successfully']);
        }
    }
}

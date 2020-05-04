<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use Illuminate\Http\Request;
use App\Models\ProjectsModel as Project;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Requests\ProjectDeleteRequest;
use App\Repositories\ProjectRepository;

class ProjectController extends Controller
{
    private $projectRepository;

    public function __construct()
    {
        $this->projectRepository = app(ProjectRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $res = $this->projectRepository->getSearchResult($request->search);
            return view('projects.index', compact('res'));
        }

        $res = $this->projectRepository->getAllWithPaginate($request);


        return view('projects.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Project();
        $employeesList = $this->projectRepository->getEmployeesList();
        return view('projects.create', compact('item', 'employeesList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectCreateRequest $request)
    {
        $data = $request->input();

        $data['reg_num'] = BaseHelper::generateID("PR", 5);
        $data['register_date'] = date("Y-m-d");

        $item = new Project($data);
        $item->save();

        if ($item) {
            return redirect()->route('projects.index')
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
        echo __METHOD__;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->getEdit($id);
        if ($project) {
            $employeesList = $employeesList = $this->projectRepository->getEmployeesList();
            return view("projects.edit", compact("project", "employeesList"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\ProjectUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        $pr = $this->projectRepository->getEdit($id);
        if (empty($pr)) {
            return back()
                ->withErrors(['msg' => "id=[{$id}] not found"])
                ->withInput();
        }
        $data = $request->input();

        $result = $pr->fill($data)->save();
        if ($result) {
            return redirect()
                ->route('projects.index')
                ->with(['success' => 'Update compete successfully']);
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
    public function destroy(ProjectDeleteRequest $request, $id)
    {
        $project = $this->projectRepository->getEdit($id);;
        $r = $project->delete();
        if ($r) {
            return redirect()->route('projects.index')
                ->with(['success' => 'Delete complete successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error']);
        }
    }
}

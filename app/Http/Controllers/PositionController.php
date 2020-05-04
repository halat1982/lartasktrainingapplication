<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\BaseHelper;
use App\Models\PositionModel as Position;
use App\Http\Requests\PositionCreateRequest;
use App\Http\Requests\PositionUpdateRequest;
use App\Repositories\PositionRepository;
use App\Http\Requests\PositionDeleteRequest;

class PositionController extends Controller
{
    private $posRepository;

    public function __construct()
    {
        $this->posRepository = app(PositionRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $res = $this->posRepository->getSearchResult($request->search);
            return view('positions.index', compact('res'));
        }

        $res = $this->posRepository->getAllWithPaginate($request);

        return view('positions.index', compact('res'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new Position();

        return view('positions.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\PositionCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionCreateRequest $request)
    {
        $success = $this->posRepository->createPosition($request);

        if ($success) {
            return redirect()->route('positions.index')
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
        $pos = $this->posRepository->getEdit($id);
        if ($pos) {
            return view("positions.edit", compact("pos"));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionUpdateRequest $request, $id)
    {
        $pos = $this->posRepository->getEdit($id);
        if (empty($pos)) {
            return back()
                ->withErrors(['msg' => "id=[{$id}] not found"])
                ->withInput();
        }
        $data = $request->input();
        $result = $pos->fill($data)->save();
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
    public function destroy(PositionDeleteRequest $request, $id)
    {
        $pos = $this->posRepository->getEdit($id);

        $r = $pos->delete();
        if ($r) {
            return redirect()->route('positions.index')
                ->with(['success' => 'Delete complete successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error']);
        }
    }
}

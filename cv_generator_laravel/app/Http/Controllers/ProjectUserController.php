<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProjectUserController extends Controller
{
    private $activePage, $titlePage;

    public function __construct()
    {
        $this->activePage = 'projects';
        $this->titlePage = 'My Projects';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();
        $projects = ProjectUser::where('detail_user_id', $detailUsers->id)->get();

        return view('projects.index')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();
        $projects = ProjectUser::where('detail_user_id', $detailUsers->id)->get();

        if (count($projects) >= 6) {
            session()->flash('pesan_warning', 'Sorry but you are only allowed to create 6 data projects at the moment.');
            return redirect()->back();
        }

        return view('projects.create')
            ->with('active_page', $this->activePage)
            ->with('title_page', $this->titlePage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $validateData = $request->validate([
                'project_name' => 'required|string|max:50',
                'project_category' => 'required|string|max:200',
                'project_created_date' => 'required|date|before_or_equal:today',
            ]);

            $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();

            $newProject = new ProjectUser();
            $newProject->detail_user_id = $detailUsers->id;
            $newProject->project_name = $validateData['project_name'];
            $newProject->project_category = $validateData['project_category'];
            $newProject->project_created_date = $validateData['project_created_date'];

            $newProject->save();

            session()->flash('pesan_success', 'Your data has been successfully added.');
            return redirect()->route('projects.index');
        }
        // Jika terjadi kesalahan validasi, tambahkan pesan error
        catch (ValidationException $e) {
            session()->flash('pesan_error', 'Something is wrong, please try again.');
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectUser $projectUser)
    {
        //
        session()->flash('pesan_warning', 'What are you trying to do?');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectUser $project)
    {
        //
        // $serviceUser = ServiceUser::findOrFail($id);
        return view('projects.edit')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectUser $project)
    {
        //
        try {
            $validateData = $request->validate([
                'project_name' => 'required|string|max:50',
                'project_category' => 'required|string|max:200',
                'project_created_date' => 'required|date|before_or_equal:today',
            ]);

            $project->update([
                'project_name' => $validateData['project_name'],
                'project_category' => $validateData['project_category'],
                'project_created_date' => $validateData['project_created_date'],
            ]);

            session()->flash('pesan_success', 'Your data has been successfully updated.');
            return redirect()->route('projects.index');
        }
        // Jika terjadi kesalahan validasi, tambahkan pesan error
        catch (ValidationException $e) {
            session()->flash('pesan_error', 'Something is wrong, please try again.');
            return redirect()->back()->withInput()->withErrors($e->validator->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectUser  $projectUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectUser $project)
    {
        //
        if ($project) {
            $project->delete(); // Soft delete
            session()->flash('pesan_success', 'Your data has been successfully deleted');
            return redirect()->back();
        } else {
            session()->flash('pesan_error', 'An error occurred, your data was not found.');
            return redirect()->back();
        }
    }
}

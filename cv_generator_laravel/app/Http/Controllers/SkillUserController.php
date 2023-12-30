<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\SkillUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SkillUserController extends Controller
{
    private $activePage, $titlePage;

    public function __construct()
    {
        $this->activePage = 'skills';
        $this->titlePage = 'My Skill';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $skillUser = SkillUser::where('detail_user_id', Auth::user()->id)->get();

        return view('skills.index')
            ->with('skillUser', $skillUser)
            ->with('active_page', $this->activePage)
            ->with('title_page', $this->titlePage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
        $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();
        $skills = SkillUser::where('detail_user_id', $detailUsers->id)->get();

        if (count($skills) >= 4) {
            session()->flash('pesan_warning', 'Sorry but you are only allowed to create 4 data skills at the moment.');
            return redirect()->back();
        }
        return view('skills.create')
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
        // dd($request);
        try {
            $validateData = $request->validate([
                'skill_name' => 'required|string|max:20',
                'skill_confident' => 'required|numeric|between:1,100',
            ]);

            $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();

            $newSkill = new SkillUser();
            $newSkill->detail_user_id = $detailUsers->id;
            $newSkill->skill_name = $validateData['skill_name'];
            $newSkill->skill_confident = $validateData['skill_confident'];

            $newSkill->save();
            session()->flash('pesan_success', 'Your data has been successfully added.');
            return redirect()->route('skills.index');
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
     * @param  \App\Models\SkillUser  $skillUser
     * @return \Illuminate\Http\Response
     */
    public function show(SkillUser $skillUser)
    {
        //
        session()->flash('pesan_warning', 'What are you trying to do?');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SkillUser  $skillUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $skillUser = SkillUser::findOrFail($id);

        return view('skills.edit')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('skillUser', $skillUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SkillUser  $skillUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $validateData = $request->validate([
                'skill_name' => 'required|string|max:20',
                'skill_confident' => 'required|numeric|between:1,100',
            ]);

            $skillUser = SkillUser::findOrFail($id);

            $skillUser->update([
                'skill_name' => $validateData['skill_name'],
                'skill_confident' => $validateData['skill_confident'],
            ]);

            session()->flash('pesan_success', 'Your data has been successfully edited.');
            return redirect()->route('skills.index');
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
     * @param  \App\Models\SkillUser  $skillUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $skillUser = SkillUser::findOrFail($id);

        if ($skillUser) {
            $skillUser->delete(); // Soft delete
            session()->flash('pesan_success', 'Your data has been successfully deleted');
            return redirect()->back();
        } else {
            session()->flash('pesan_error', 'An error occurred, your data was not found.');
            return redirect()->back();
        }
    }
}

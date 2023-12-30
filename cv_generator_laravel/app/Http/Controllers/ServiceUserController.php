<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ServiceUserController extends Controller
{
    private $titlePage, $activePage;
    public function __construct()
    {
        $this->titlePage = 'Services';
        $this->activePage = 'services';
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
        $services = ServiceUser::where('detail_user_id', $detailUsers->id)->get();

        return view('services.index')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('services', $services);
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
        $services = ServiceUser::where('detail_user_id', $detailUsers->id)->get();

        if (count($services) >= 6) {
            session()->flash('pesan_warning', 'Sorry but you are only allowed to create 6 data services at the moment.');
            return redirect()->back();
        }
        return view('services.create')
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
                'service_name' => 'required|string|max:50',
                'service_detail' => 'required|string|max:200',
            ]);

            $detailUsers = DetailUser::where('user_id', Auth::user()->id)->first();

            $newService = new ServiceUser();
            $newService->detail_user_id = $detailUsers->id;
            $newService->service_name = $validateData['service_name'];
            $newService->service_detail = $validateData['service_detail'];

            $newService->save();
            session()->flash('pesan_success', 'Your data has been successfully added.');
            return redirect()->route('services.index');
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
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceUser $serviceUser)
    {
        //
        session()->flash('pesan_warning', 'What are you trying to do?');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $serviceUser = ServiceUser::findOrFail($id);
        return view('services.edit')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('serviceUser', $serviceUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $validateData = $request->validate([
                'service_name' => 'required|string|max:50',
                'service_detail' => 'required|string|max:200',
            ]);

            $serviceUser = ServiceUser::findOrFail($id);

            $serviceUser->update([
                'service_name' => $validateData['service_name'],
                'service_detail' => $validateData['service_detail'],
            ]);

            session()->flash('pesan_success', 'Your data has been successfully edited.');
            return redirect()->route('services.index');
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
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($serviceUser);
        $serviceUser = ServiceUser::findOrFail($id);

        if ($serviceUser) {
            $serviceUser->delete(); // Soft delete
            session()->flash('pesan_success', 'Your data has been successfully deleted');
            return redirect()->back();
        } else {
            session()->flash('pesan_error', 'An error occurred, your data was not found.');
            return redirect()->back();
        }
    }
}

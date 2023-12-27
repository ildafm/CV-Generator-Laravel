<?php

namespace App\Http\Controllers;

use App\Models\DetailUser;
use App\Models\ServiceUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceUser $serviceUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceUser $serviceUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceUser  $serviceUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceUser $serviceUser)
    {
        //
    }
}

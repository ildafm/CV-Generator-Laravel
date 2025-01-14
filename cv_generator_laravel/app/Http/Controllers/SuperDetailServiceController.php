<?php

namespace App\Http\Controllers;

use App\Models\SuperDetailService;
use Illuminate\Http\Request;

class SuperDetailServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $titlePage, $activePage;

    public function __construct()
    {
        $this->titlePage = 'Services';
        $this->activePage = 'services';
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($service_id)
    {
        //
        return view('services.detail_services')
            ->with('title_page', $this->titlePage)
            ->with('active_page', $this->activePage)
            ->with('service_id', $service_id);
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
     * @param  \App\Models\SuperDetailService  $superDetailService
     * @return \Illuminate\Http\Response
     */
    public function show(SuperDetailService $superDetailService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuperDetailService  $superDetailService
     * @return \Illuminate\Http\Response
     */
    public function edit(SuperDetailService $superDetailService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuperDetailService  $superDetailService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuperDetailService $superDetailService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuperDetailService  $superDetailService
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuperDetailService $superDetailService)
    {
        //
    }
}

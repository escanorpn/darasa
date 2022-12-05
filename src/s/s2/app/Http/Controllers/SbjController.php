<?php

namespace App\Http\Controllers;

use App\Models\sbj;
use App\Http\Requests\StoresbjRequest;
use App\Http\Requests\UpdatesbjRequest;

class SbjController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoresbjRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoresbjRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sbj  $sbj
     * @return \Illuminate\Http\Response
     */
    public function show(sbj $sbj)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sbj  $sbj
     * @return \Illuminate\Http\Response
     */
    public function edit(sbj $sbj)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatesbjRequest  $request
     * @param  \App\Models\sbj  $sbj
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatesbjRequest $request, sbj $sbj)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sbj  $sbj
     * @return \Illuminate\Http\Response
     */
    public function destroy(sbj $sbj)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TravelType;
use App\Http\Requests\StoreTravelTypeRequest;
use App\Http\Requests\UpdateTravelTypeRequest;

class TravelTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreTravelTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTravelTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TravelType  $travelType
     * @return \Illuminate\Http\Response
     */
    public function show(TravelType $travelType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TravelType  $travelType
     * @return \Illuminate\Http\Response
     */
    public function edit(TravelType $travelType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTravelTypeRequest  $request
     * @param  \App\Models\TravelType  $travelType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTravelTypeRequest $request, TravelType $travelType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TravelType  $travelType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TravelType $travelType)
    {
        //
    }
}

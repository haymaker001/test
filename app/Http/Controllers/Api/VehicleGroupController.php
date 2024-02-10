<?php

namespace App\Http\Controllers\Api;

use App\Models\VehicleGroup;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleGroupRequest;
use App\Http\Requests\UpdateVehicleGroupRequest;

class VehicleGroupController extends Controller
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
     * @param  \App\Http\Requests\StoreVehicleGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleGroupRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function show(VehicleGroup $vehicleGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleGroup $vehicleGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleGroupRequest  $request
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleGroupRequest $request, VehicleGroup $vehicleGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleGroup  $vehicleGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleGroup $vehicleGroup)
    {
        //
    }
}

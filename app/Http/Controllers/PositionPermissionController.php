<?php

namespace App\Http\Controllers;

use App\Models\PositionPermission;
use App\Http\Requests\StorePositionPermissionRequest;
use App\Http\Requests\UpdatePositionPermissionRequest;

class PositionPermissionController extends Controller
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
     * @param  \App\Http\Requests\StorePositionPermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePositionPermissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PositionPermission  $positionPermission
     * @return \Illuminate\Http\Response
     */
    public function show(PositionPermission $positionPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PositionPermission  $positionPermission
     * @return \Illuminate\Http\Response
     */
    public function edit(PositionPermission $positionPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePositionPermissionRequest  $request
     * @param  \App\Models\PositionPermission  $positionPermission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePositionPermissionRequest $request, PositionPermission $positionPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PositionPermission  $positionPermission
     * @return \Illuminate\Http\Response
     */
    public function destroy(PositionPermission $positionPermission)
    {
        //
    }
}

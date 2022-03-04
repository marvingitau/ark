<?php

namespace App\Http\Controllers;

use App\Models\TaskThread;
use App\Http\Requests\StoreTaskThreadRequest;
use App\Http\Requests\UpdateTaskThreadRequest;

class TaskThreadController extends Controller
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
     * @param  \App\Http\Requests\StoreTaskThreadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskThreadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskThread  $taskThread
     * @return \Illuminate\Http\Response
     */
    public function show(TaskThread $taskThread)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskThread  $taskThread
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskThread $taskThread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskThreadRequest  $request
     * @param  \App\Models\TaskThread  $taskThread
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskThreadRequest $request, TaskThread $taskThread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskThread  $taskThread
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskThread $taskThread)
    {
        //
    }
}

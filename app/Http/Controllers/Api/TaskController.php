<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $tasks;
    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection|Tasks[]
     */
    public function index()
    {
        return $this->tasks->all();
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
     * @param  Tasks  $tasks
     * @return Tasks
     */
    public function show(Tasks $tasks)
    {
        return $tasks;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

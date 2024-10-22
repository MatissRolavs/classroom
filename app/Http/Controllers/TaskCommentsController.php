<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskCommentsRequest;
use App\Http\Requests\UpdateTaskCommentsRequest;
use App\Models\TaskComments;

class TaskCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskCommentsRequest $request)
    {
        $comment = new TaskComments();
        $comment->user_id = $request->user_id;
        $comment->task_id = $request->task_id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->route('subject.show', $request->class_id)->with('message', 'Comment created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskComments $taskComments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskComments $taskComments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskCommentsRequest $request, TaskComments $taskComments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskComments $taskComments)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TaskGrade;
use App\Http\Requests\StoreTaskGradeRequest;
use App\Http\Requests\UpdateTaskGradeRequest;

class TaskGradeController extends Controller
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
    public function store(StoreTaskGradeRequest $request)
    {
        TaskGrade::create([
            'task_id' => $request->task_id,
            'user_id' => $request->student_id,
            'grade' => $request->grade,
        ]);

        return redirect()->route('subject.show', $request->subject_id)->with('message', 'Grade created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskGrade $taskGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskGrade $taskGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskGradeRequest $request, TaskGrade $taskGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskGrade $taskGrade)
    {
        //
    }
}

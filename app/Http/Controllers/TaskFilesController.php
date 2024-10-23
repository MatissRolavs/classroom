<?php

namespace App\Http\Controllers;

use App\Models\TaskFiles;
use App\Http\Requests\StoreTaskFilesRequest;
use App\Http\Requests\UpdateTaskFilesRequest;
use Illuminate\Support\Facades\Storage;
class TaskFilesController extends Controller
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
    public function store(StoreTaskFilesRequest $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);
    
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
    
        // Additional logic (e.g., storing file information in the database)
        $taskFiles = TaskFiles::create([
            "task_id" => $request->task_id,
            "file" => $file,
            "path" => $path,	
            "creator_id" => auth()->user()->id
        ]);
   
        return redirect()->route('subject.show', $request->subject_id)->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $taskFile = TaskFiles::findOrFail($id);
        return view('file.show', ['taskFile' => $taskFile]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskFiles $taskFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskFilesRequest $request, TaskFiles $taskFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskFiles $taskFiles)
    {
        //
    }
}

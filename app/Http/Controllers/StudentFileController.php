<?php

namespace App\Http\Controllers;

use App\Models\StudentFile;
use App\Http\Requests\StoreStudentFileRequest;
use App\Http\Requests\UpdateStudentFileRequest;

class StudentFileController extends Controller
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
    public function store(StoreStudentFileRequest $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);
    
        $file = $request->file('file');
        $path = $file->store('uploads', 'public');
    
        // Additional logic (e.g., storing file information in the database)
        $studentFiles = StudentFile::create([
            "task_id" => $request->task_id,
            "file" => $file,
            "path" => $path,	
            "student_id" => auth()->user()->id
        ]);
   
        return redirect()->route('subject.show', $request->task_id)->with('success', 'File uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentFile $studentFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentFile $studentFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentFileRequest $request, StudentFile $studentFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentFile $studentFile)
    {
        //
    }
}

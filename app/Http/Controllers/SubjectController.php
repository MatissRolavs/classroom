<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresubjectRequest;
use App\Http\Requests\UpdatesubjectRequest;
use App\Models\subject;
use App\Models\TaskComments;
use App\Models\UserSubjects;
use App\Models\Tasks;
use App\Models\TaskFiles;
use App\Models\User;
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = subject::all();
        $user_subjects = UserSubjects::all();

        return view('subject.index', compact('subjects'), compact("user_subjects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresubjectRequest $request)
    {
        subject::create([
            'name' => $request->name,
            "creator_id" => auth()->user()->id,
            'group' => $request->group,
            'description' => $request->description,
            'code' => $request->code,
        ]);
        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(subject $subject)
    {   
        $users = User::all();
        $tasks = Tasks::all();
        $taskFiles = TaskFiles::all();
        $comments = TaskComments::all();
        return view('subject.show', compact('subject','tasks','taskFiles',"comments","users"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesubjectRequest $request, subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subject $subject)
    {
        //
    }

    public function leave(subject $subject)
    {
        $userSubjects = UserSubjects::where('user_id', auth()->user()->id)->where('subject_id', $subject->id)->first();
        $userSubjects->delete();
        return redirect()->route("subject.index");
    }

    public function participants(){
        $user_subjects = UserSubjects::all();
        $users = User::all();
        return view("subject.participants", compact("user_subjects", "users"));
    }
}

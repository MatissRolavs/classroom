<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserSubjectsRequest;
use App\Http\Requests\UpdateUserSubjectsRequest;
use App\Models\UserSubjects;
use App\Models\subject;

class UserSubjectsController extends Controller
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
        return view('user_subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserSubjectsRequest $request)
    {
        $existingSubject = subject::where('code', $request->code)->first();

        if ($existingSubject) {
            UserSubjects::create([
                'user_id' => $request->user_id,
                'subject_id' => $existingSubject->id,
                "code" => $request->code
            ]);
        } else {
            UserSubjects::create([
                'user_id' => $request->user_id,
                'subject_id' => $request->subject_id,
                "code" => $request->code
            ]);
        }

        return redirect()->route('subject.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSubjects $userSubjects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSubjects $userSubjects)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserSubjectsRequest $request, UserSubjects $userSubjects)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSubjects $userSubjects)
    {
        //
    }
}

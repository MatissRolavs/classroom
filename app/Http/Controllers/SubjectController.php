<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoresubjectRequest;
use App\Http\Requests\UpdatesubjectRequest;
use App\Models\subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = subject::all();
        return view('subject.index', compact('subjects'));
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
        return view('subject.show', compact('subject'));
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
}

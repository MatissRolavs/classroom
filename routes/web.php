<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskCommentsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\UserSubjectsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskFilesController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Admin;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get("/create/class", [SubjectController::class, "create"])->name("subject.create");
    Route::post("/create/class", [SubjectController::class, "store"])->name("subject.store");
    Route::get("/classes", [SubjectController::class, "index"])->name("subject.index");
    Route::get("/classes/{subject}", [SubjectController::class, "show"])->name("subject.show");


    Route::post("/classes", [UserSubjectsController::class, "store"])->name("user_subjects.store");
    Route::delete("/classes/{subject}/leave", [SubjectController::class, "leave"])->name("subject.leave");
    
    Route::post("/tasks", [TasksController::class, "store"])->name("task.store");
    Route::post("/taskFiles", [TaskFilesController::class, "store"])->name("taskFiles.store");	
    Route::get("/taskFiles/{taskFiles}", [TaskFilesController::class, "show"])->name("taskFiles.show");

    Route::post("/comment/create", [TaskCommentsController::class, "store"])->name("comments.store");

    Route::get("/classes/{subject}/participants", [SubjectController::class, "participants"])->name("subject.participants");

    Route::get("/register/teacher", [AdminController::class, "create"])->name("users.create");
    Route::post("/register/teacher", [AdminController::class, "store"])->name("users.store");

    Route::middleware('can:enroll,subject')->group(function () {
        Route::post("/classes/{subject}/enroll", [SubjectController::class, "enroll"])->name("subject.enroll");
        Route::post("/classes/{subject}/unenroll", [SubjectController::class, "unenroll"])->name("subject.unenroll");
    });

    Route::get('/calendar/{month?}/{year?}', [CalendarController::class, 'show'])->name('calendar.show');

});

require __DIR__.'/auth.php';

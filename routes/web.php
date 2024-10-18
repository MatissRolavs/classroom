<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserSubjectsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::resource('subject', SubjectController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get("/create/class", [SubjectController::class, "create"])->name("subject.create");
    Route::post("/create/class", [SubjectController::class, "store"])->name("subject.store");
    Route::get("/classes", [SubjectController::class, "index"])->name("subject.index");
    Route::get("/classes/{subject}", [SubjectController::class, "show"])->name("subject.show");


    Route::post("/classes", [UserSubjectsController::class, "store"])->name("user_subjects.store");
    

    // Route::post("/classes/{subject}/enroll", [SubjectController::class, "enroll"])->name("subject.enroll");
    // Route::post("/classes/{subject}/unenroll", [SubjectController::class, "unenroll"])->name("subject.unenroll");


    Route::middleware('can:enroll,subject')->group(function () {
        Route::post("/classes/{subject}/enroll", [SubjectController::class, "enroll"])->name("subject.enroll");
        Route::post("/classes/{subject}/unenroll", [SubjectController::class, "unenroll"])->name("subject.unenroll");
    });


    // Route::get('/calendar/{month?}/{year?}', [CalendarController::class, 'show'])->middleware('can:view,App\Models\Subject')->name('calendar.show');
    Route::get('/calendar/{month?}/{year?}', [CalendarController::class, 'show'])->name('calendar.show');

});

require __DIR__.'/auth.php';

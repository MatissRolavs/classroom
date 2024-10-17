<?php
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    
});
Route::get('/calendar/{month?}/{year?}', [CalendarController::class, 'show']);
require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Auth\HireController;
use App\Http\Controllers\Auth\TestimonyController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\SummaryController;
use App\Models\Testimony;
use Illuminate\Support\Facades\Route;



//===================================================================
//                            CUSTOM ROUTES
//=================================================================
//=======================================
//Show in Dashboard Route
//=======================================

Route::get('/dashboard', [
    LandingpageController::class, 'showInLandingpage'
])->middleware(['auth', 'verified'])->name('dashboard');



//=======================================
//Show in Show Route
//=======================================
Route::get('/uploads/show', [
    ShowController::class, 'showInDashboard'
])->middleware(['auth', 'verified'])->name('show');



//=======================================
//Summary Routes
//=======================================

//Create page
Route::get('/uploads/summary', [
    SummaryController::class, 'create'
])->middleware(['auth', 'verified'])->name('summary');

//Store
Route::post('/uploads/summary', [
    SummaryController::class, 'store'
])->middleware(['auth', 'verified'])->name('summaries.store');

//Edit page
Route::get('/uploads/edit-summary/{summary}', [
    SummaryController::class, 'edit'
])->middleware(['auth', 'verified'])->name('summary.edit');

//Update
Route::patch('/uploads/edit-summary/{summary}', [
    SummaryController::class, 'update'
])->middleware(['auth', 'verified'])->name('summary.update');

//delete
Route::delete('/uploads/edit-summary/{summary}', [
    SummaryController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('summary.destroy');



//=======================================
//Education Routes
//=======================================

//Create page
Route::get('/uploads/education', [
    EducationController::class, 'create'
])->middleware(['auth', 'verified'])->name('education');

//Store
Route::post('/uploads/education', [
    EducationController::class, 'store'
])->middleware(['auth', 'verified'])->name('education.store');

//Edit page
Route::get('/uploads/edit-education/{education}', [
    EducationController::class, 'edit'
])->middleware(['auth', 'verified'])->name('education.edit');

//Update
Route::patch('/uploads/edit-education/{education}', [
    EducationController::class, 'update'
])->middleware(['auth', 'verified'])->name('education.update');

//delete
Route::delete('/uploads/show{education}', [
    EducationController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('education.destroy');




//=======================================
//Experience Routes
//=======================================

//Create Page
Route::get('/uploads/experience', [
    ExperienceController::class, 'create'
])->middleware(['auth', 'verified'])->name('experience');

//Store
Route::post('/uploads/experience', [
    ExperienceController::class, 'store'
])->middleware(['auth', 'verified'])->name('experiences.store');

//Edit page
Route::get('/uploads/edit-experience/{experience}', [
    ExperienceController::class, 'edit'
])->middleware(['auth', 'verified'])->name('experience.edit');

//Update
Route::patch('/uploads/edit-experience/{experience}', [
    ExperienceController::class, 'update'
])->middleware(['auth', 'verified'])->name('experience.update');

//delete
Route::delete('/uploads/show/{experience}', [
    ExperienceController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('experience.destroy');



//=======================================
//Portfolio Routes
//=======================================



Route::controller(PortfolioController::class)->group(function () {

    // create page
    Route::get('/uploads/portfolio', 'create')
    ->middleware(['auth', 'verified'])->name('portfolio');

    //Stores value
    Route::post('/uploads/portfolio', 'store')
    ->middleware(['auth', 'verified'])->name('portfolio.store');

    //Edit page
    Route::get('/uploads/edit-portfolio/{portfolio}', 'edit')
    ->middleware(['auth', 'verified'])->name('portfolio.edit');

    //Update
    Route::patch('/uploads/edit-portfolio/{portfolio}', 'update')
    ->middleware(['auth', 'verified'])->name('portfolio.update');

    //delete
    Route::delete('/uploads/edit-portfolio/{portfolio}', 'destroy')
    ->middleware(['auth', 'verified'])->name('portfolio.destroy');

});



//=======================================
//Resume Routes
//=======================================

//Create page
Route::get('/uploads/resume', [
    ResumeController::class, 'create'
])->middleware(['auth', 'verified'])->name('resume');

//Store
Route::post('/uploads/resume', [
    ResumeController::class, 'store'
])->middleware(['auth', 'verified'])->name('resume.store');

//Edit
Route::get('/uploads/edit-resume/{resume}', [
    ResumeController::class, 'edit'
])->middleware(['auth', 'verified'])->name('resume.edit');

//Update
Route::patch('/uploads/edit-resume/{resume}', [
    ResumeController::class, 'update'
])->middleware(['auth', 'verified'])->name('resume.update');

//delete
Route::delete('/uploads/edit-resume/{resume}', [
    ResumeController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('resume.destroy');

//=========================================
//  CUSTOM ROUTES ENDS
//=========================================



//=========================================
//  HIRE ROUTES
//=========================================

//create Hire form
Route::get('hire', function () {
    return view('auth.hire');
})->middleware(['guest'])->name('hire');

//delete
Route::delete('/dashboard/{hire}', [
    HireController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('hire.destroy');



//=========================================
//  TESTIMONY ROUTES
//=========================================

//create Testimony form
Route::get('testimony', function () {
    return view('auth.testimony');
})->middleware(['guest'])->name('testimony');

//delete
Route::delete('/dashboard{testimony}', [
    TestimonyController::class, 'destroy'
])->middleware(['auth', 'verified'])->name('testimony.destroy');


//Route to toggle betweeen Completed Task and Uncompleted Task
Route::put('/dashboard/{testimony}/toggle-approved', function (Testimony $testimony){

    $testimony->toggleApproved();
    return redirect()->back()->with('success','done');
    
})->middleware(['auth', 'verified'])->name('testimony.approved');




//=========================================
//  PROFILE ROUTES
//=========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

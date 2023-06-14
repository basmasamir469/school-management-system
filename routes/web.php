<?php

use App\Http\Controllers\GradeClasses\GradeClassController;
use App\Http\Controllers\GradeClasses\SectionController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// routes/web.php
Auth::routes();
Route::group(['prefix' => LaravelLocalization::setLocale(),	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
], function()
{
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
	Route::get('/', function()
	{
        return view('dashboard');
	});
	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
	Route::group(['namespace'=>'Grades'],function(){
		Route::resource('Grades','GradeController');
		Route::get('Grades/grades_classes/{id}',[GradeController::class,'gradeClasses'])->name('Grades.get_classes');
	});

	Route::group(['namespace'=>'GradeClasses'],function(){
		Route::resource('GradeClasses',GradeClassController::class);
		Route::post('GradeClasses/delete/checked',[GradeClassController::class,'deleteChecked'])->name('GradeClasses.deleteChecked');
		Route::post('GradeClasses/filter/grade',[GradeClassController::class,'filterGrade'])->name('GradeClasses.filterGrade');
		Route::get('GradeClasses/sections/{id}',[GradeClassController::class,'getSections'])->name('GradeClasses.get_sections');
		Route::resource('Sections',SectionController::class);
	});

	Route::group(['namespace'=>'Teachers'],function(){
		Route::resource('Teachers','TeacherController');
	});

	Route::group(['namespace'=>'Students'],function(){
		Route::resource('Students','StudentController');
	});




// Route::get('/empty',[HomeController::class,'empty']);
Route::view('/addparent','livewire.show-form')->name('add_parent');
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/




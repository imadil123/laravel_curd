<?php

use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Builder\FallbackBuilder;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;


Route::get('/', function () {
    // view file name
    return view('welcome'); 
});

Route::get('/students/ajax', [StudentController::class, 'fetchStudents'])->name('students.fetch');
Route::get('/students/search', [StudentController::class, 'searchStudents'])->name('search.students');

Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');



Route::get('/user/{id}', function ($id) {
    return "<h1>user id: ".$id." </h1>";
})->name( 'view.user');

Route::middleware(['auth'])->group(function () {
    Route::controller(StudentController::class)->group(function() {
        Route::get('/students', 'ShowStudent')->name('view.students');
        Route::get('/students/{id}', 'singleUser')->name('view.user');
        Route::post('/add', 'addStudent')->name('add.user');
        // Route::post('/update/{id}', 'updateStudent')->name('update.user');
        // Route::get('/updatePage/{id}', 'updatepage')->name('update.page');
        // Route::get('/delete/{id}', 'deleteStudent')->name('delete.user');
    });
});


Route::middleware(['auth'])->group(function () {
    Route::controller(SubjectController::class)->group(function() {
        Route::get('/subjects','index')->name('subjects.index');
        Route::get('/subjects/create', 'create')->name('subjects.create');
        Route::post('/subjects', 'store')->name('subjects.store');
        Route::get('/subjects/{id}/edit','edit')->name('subjects.edit');
        Route::put('/subjects/{id}','update')->name('subjects.update');
        Route::delete('/subjects/{id}','destroy')->name('subjects.destroy');
    });
});
    

// new user page
Route::view('/newUser', 'newUser');

// registration Route 
Route::view('/RegistrationPage', 'registration')->name('registration.user');
Route::post('/RegistrationSave', [UserController::class, 'register'])->name('registrationSave');

// login Route
Route::view('/loginPage', 'login')->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout.user');


















// Route::controller(PageController::class)->group(function(){
    
// Route::get('/','ShowHome')->name('home');
// Route::get('/blog','ShowBlog')->name('blog');
// Route::get('/demo/{id}','ShowUser')->name('user');

// });

// Route::get('/test', [TestingController::class, '__invoke'])->name('test');

// Route::get('/demoooo', function () {
//     return view('demo');
// })->name('demo');


// Route::get('/demo/first', function () {
//     return view('first');
// });

// Route::fallback(function () {
//     return "404 Not Found";
// });

// Route::get('/users', function () {

//     $names = [
//         1 =>['name' => 'John', 'age' => 25, 'city' => 'New York'],
//         2 =>['name' => 'adil', 'age' => 25, 'city' => 'New jodhpur'],
//         3 =>['name' => 'John', 'age' => 25, 'city' => 'delhi'],
//         4 =>['name' => 'John', 'age' => 25, 'city' => 'munbai'],
//     ];

//     return view('users',
//     ['user' => $names]
// );
// });





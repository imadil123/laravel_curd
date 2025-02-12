<?php

use Illuminate\Support\Facades\Route;
use Ramsey\Uuid\Builder\FallbackBuilder;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    // view file name
    return view('welcome');
});
 

Route::get('/user/{id}', function ($id) {
    return "<h1>user id: ".$id." </h1>";
})->name( 'view.user');


Route::controller(StudentController::class)->group(function(){

    Route::get('/students', 'ShowStudent')->name('view.students');
    Route::get('/students/{id}', 'singleUser')->name('view.user');
    Route::post('/add', 'addStudent')->name('add.user');
    Route::post('/update/{id}', 'updateStudent')->name('update.user');
    Route::get('/updatePage/{id}', 'updatepage')->name('update.page');
    Route::get('/delete/{id}', 'deleteStudent')->name('delete.user');
    
});
Route::view('/newUser', 'newUser');



// registration Route 
Route::view('/RegistrationPage', 'registration')->name('registration.user');
Route::post('/RegistrationSave', [UserController::class, 'register'])->name('registrationSave');

// login Route
Route::view('/loginPage', 'login')->name('login.user');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');


















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





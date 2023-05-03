<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use GuzzleHttp\Promise\TaskQueue;
use App\Http\Controllers\Auth\RegisterController;

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

Auth::routes();

Route::middleware('auth')->group(function () {
       Route::get('/', [TaskController::class, 'index'])->name('home');

       Route::prefix('task')->controller(TaskController::class)->name('task.')->group(function () {
              Route::get('/', 'index')->name('index');
              Route::get('/create', 'create')->name('create');
              Route::post('/store', 'store')->name('store');
              Route::get('/view/{id}', 'show')->name('view');
              Route::get('/edit/{id}', 'edit')->name('edit');
              Route::post('/update/{id}', 'update')->name('update');
              Route::delete('/delete/{id}', 'destroy')->name('delete');
              Route::put('/filedOrUnfiled/{id}', 'filedOrUnfiled')->name('filedOrUnfiled');
       });

       Route::prefix('profile')->controller(ProfileController::class)->name('profile.')->group(function () {
              Route::get('/', 'edit')->name('edit');
              Route::patch('/update', 'update')->name('update');
              Route::prefix('password')->controller(PasswordController::class)->name('password.')->group(function () {
                     Route::get('/', 'edit')->name('edit');
                     Route::patch('/update', 'update')->name('update');
              });
       });

       Route::prefix('user')->controller(RegisterController::class)->name('user.')->group(function () {
              Route::get('/', 'index')->name('index');
              Route::get('/create', 'create')->name('create');
              Route::post('/store', 'store')->name('store');
              Route::get('/edit/{id}', 'edit')->name('edit');
              Route::patch('/update/{id}', 'update')->name('update');
              Route::delete('/delete/{id}', 'destroy')->name('delete');
       });

});

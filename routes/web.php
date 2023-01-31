<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//employee
Route::get('admin/employee', [App\Http\Controllers\HomeController::class, 'employees']);
Route::get('admin/employee/add',[App\Http\Controllers\HomeController::class, 'create'])->name('admin.employee.create');
Route::post('admin/employee/add',[App\Http\Controllers\HomeController::class, 'store'])->name('admin.employee.store');
Route::get('admin/employee/update/{id}',[App\Http\Controllers\HomeController::class, 'edit'])->name('admin.employee.edit');
Route::post('admin/employee/update/{id}',[App\Http\Controllers\HomeController::class, 'update'])->name('admin.employee.update');
Route::get('admin/employee/lock/{id}',[App\Http\Controllers\HomeController::class, 'lock'])->name('admin.employee.lock');
Route::get('admin/employee/delete/{id}',[App\Http\Controllers\HomeController::class, 'deleteEmployee'])->name('admin.employee.delete');


//user
Route::get('admin/users', [App\Http\Controllers\HomeController::class, 'users']);
Route::get('admin/edit-user/{id}', [App\Http\Controllers\HomeController::class, 'editUser'])->name('admin.edit.user');
Route::post('admin/update-user/{id}', [App\Http\Controllers\HomeController::class, 'updateUser'])->name('admin.update.user');
Route::get('admin/delete-user/{id}', [App\Http\Controllers\HomeController::class, 'deleteUser'])->name('admin.delete.user');
Route::post('/home',[App\Http\Controllers\HomeController::class, 'changePass'])->name('admin.change-pass');
Route::get('/admin/ajax-active/{active}',[App\Http\Controllers\HomeController::class, 'ajaxActive']);


//loan contract
Route::get('admin/contracts', [App\Http\Controllers\HomeController::class, 'contracts']);
Route::get('admin/contract/update/{id}',[App\Http\Controllers\HomeController::class, 'editContract'])->name('admin.contract.edit');
Route::post('admin/contract/update',[App\Http\Controllers\HomeController::class, 'updateContract'])->name('admin.contract.update');
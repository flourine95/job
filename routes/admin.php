<?php

use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
return view('layout.master');
})->name('welcome');

Route::group([
'as' => 'users.',
'prefix' => 'users',
], function () {
Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/{user}', [UserController::class, 'show'])->name('show');
});

<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FormController::class, 'show'])->name('show');
Route::get('index', [FormController::class, 'index'])->name('index');
Route::post('store', [FormController::class, 'store'])->name('form.store');
Route::get('/form/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
Route::put('/form/{id}', [FormController::class, 'update'])->name('form.update');
Route::delete('/form/{id}', [FormController::class, 'destroy'])->name('form.destroy');

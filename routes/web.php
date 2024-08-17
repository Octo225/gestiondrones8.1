<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\MaterialController;


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



Route::get('/Material', [MaterialController::class, 'index'])->name('Material.index');
Route::get('/Material/create', [MaterialController::class, 'create'])->name('Material.create');
Route::post('/Material', [MaterialController::class, 'store'])->name('Material.store');
Route::get('/Material/{material}/edit', [MaterialController::class, 'edit'])->name('Material.edit');
Route::match(['put', 'patch'], '/Material/{material}', [MaterialController::class, 'update'])->name('Material.update');
Route::delete('/Material/{material}', [MaterialController::class, 'destroy'])->name('Material.destroy');
Route::delete('/Material/{material}/removeImage', [MaterialController::class, 'removeImage'])->name('Material.removeImage');
Route::get('/Material/generar-pdf-todos', [MaterialController::class, 'generarPdfTodos'])->name('Material.pdfTodos');


Route::get('/', [PrestamoController::class, 'index'])->name('Prestamo.index');
Route::get('/Prestamo/create', [PrestamoController::class, 'create'])->name('Prestamo.create');
Route::post('/Prestamo', [PrestamoController::class, 'store'])->name('Prestamo.store');
Route::get('/Prestamo/{prestamo}/edit', [PrestamoController::class, 'edit'])->name('Prestamo.edit');
Route::match(['put', 'patch'], '/Prestamo/{prestamo}', [PrestamoController::class, 'update'])->name('Prestamo.update');
Route::delete('/Prestamo/{prestamo}', [PrestamoController::class, 'destroy'])->name('Prestamo.destroy');
Route::match(['put', 'patch'], '/Prestamo/{prestamo}/devolver', [PrestamoController::class, 'devolver'])->name('Prestamo.devolver');
Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
Route::post('/Prestamo/generar-pdf', [PrestamoController::class, 'generarPdf'])->name('Prestamo.generarPdf');
Route::get('/Prestamos/generar-pdf-todos', [PrestamoController::class, 'generarPdfTodos'])->name('Prestamo.pdfTodos');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

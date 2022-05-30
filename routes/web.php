<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RefundController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/kgweb', [HomeController::class, 'index'])->name('index');
Route::get('/kgweb/aboutUS', [HomeController::class, 'aboutus']);
Route::get('/kgweb/list', [HomeController::class, 'listpaket']);

Route::get('/kgweb/login', [LoginController::class, 'index'])->name('index');
Route::post('/kgweb/logged', [LoginController::class, 'doLogin']);
Route::get('/kgweb/logout', [LoginController::class, 'Logout']);
Route::get('/kgweb/{id}/profile', [LoginController::class, 'viewProfile']);
Route::get('/kgweb/{id}/package', [LoginController::class, 'viewPackage']);
Route::get('/kgweb/{id}/editProfile', [LoginController::class, 'editProfile']);
Route::put('/kgweb/{id}/updateProfile', [LoginController::class, 'updateProfile']);

Route::get('/kgweb/regis', [RegisController::class, 'index'])->name('index');
Route::get('/kgweb/regis/{type}', [RegisController::class, 'create'])->name('create');
Route::post('/kgweb/registrasi', [RegisController::class, 'store']);

Route::get('/kgweb/paket/createPaket', [PaketController::class, 'createPaket'])->name('createPaket');
Route::post('/kgweb/paket/inputPaket', [PaketController::class, 'inputPaket']);
Route::get('/kgweb/paket/{id}/editPaket', [PaketController::class, 'editPaket']);
Route::put('/kgweb/paket/{id}/updatePaket', [PaketController::class, 'updatePaket']);
Route::get('/kgweb/paket/{id}/viewPaket', [PaketController::class, 'viewPaket']);
Route::delete('/kgweb/paket/{id}', [PaketController::class, 'deletePaket']);

Route::get('/kgweb/{id}/rate', [RatingController::class, 'viewRating'])->name('viewRating');
Route::post('/kgweb/{id}/rate', [RatingController::class, 'rate']);

Route::post('/kgweb/{id}/book', [BookingController::class, 'book']);
Route::post('/kgweb/{id}/booking', [BookingController::class, 'booking']);

Route::post('/kgweb/{id}/refund', [RefundController::class, 'refund']);
Route::post('/kgweb/{id}/refundBook', [RefundController::class, 'refundBook']);
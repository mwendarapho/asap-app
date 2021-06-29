<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;

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



Route::resource('member', MemberController::class)->middleware('auth');
Route::middleware(['auth'])->group(function (){
Route::get('member-current',[MemberController::class,'current'])->name('member.current');
Route::get('member-past',[MemberController::class,'past'])->name('member.past');
Route::resource('invoice',\App\Http\Controllers\InvoiceController::class);
Route::resource('item',ItemController::class);
Route::resource('payment',PaymentController::class);

Route::post('statement100',[PaymentController::class,'statement100'])->name('statement100');
Route::post('statement',[PaymentController::class,'statement'])->name('statement');
Route::get('statement',[PaymentController::class,'statementFilter'])->name('statementFilter');



Route::get('/', function () {

  return view('home');
});
//Route::get('receipt', function () {
  //  return view('receipts.index');
//});
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CreditnoteController;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Auth;


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
    Route::get('sahayak',[MemberController::class,'sahayak'])->name('member.sahayak');
    Route::get('full-member',[MemberController::class,'fullMember'])->name('member.full');
    //Route::get('paidup-member',[MemberController::class,'paidUp'])->name('member.paid');
    Route::get('paidup-member',[MemberController::class,'paidUpFilter'])->name('member.paid');
    //Route::get('notpaidup-member',[MemberController::class,'paidUpFilter'])->name('member.paid');

    Route::post('paidup',[MemberController::class,'paidup'])->name('member.paidup');

    //Route::get('notpaidup-member',[MemberController::class,'notPaidUp'])->name('member.notpaid');

    Route::resource('invoice',\App\Http\Controllers\InvoiceController::class);
    Route::resource('item',ItemController::class);
    Route::resource('payment',PaymentController::class);

    /*Route::post('statement100',[PaymentController::class,'statement100'])->name('statement100');*/
    Route::post('statement',[PaymentController::class,'statement'])->name('statement');
    Route::get('statement',[PaymentController::class,'statementFilter'])->name('statementFilter');
    Route::resource('credit',CreditnoteController::class);


    Route::get('/', function () {

      //return view('home');
        return redirect()->route('home');
    });
    //Route::get('receipt', function () {
      //  return view('receipts.index');
    //});
    
        Route::get('import-member', [MemberController::class, 'fileImportExport'])->name('importmember');
        Route::post('import-member', [MemberController::class, 'fileImport'])->name('importmember');
        //Route::get('file-export', [UserController::class, 'fileExport'])->name('file-export');
        Route::get('import-invoice', [InvoiceController::class, 'importInvoice']);
        Route::post('import-invoice', [InvoiceController::class, 'fileImport'])->name('importinvoice');
        Route::get('import-payment', [PaymentController::class, 'importPayment']);
        Route::post('import-payment', [PaymentController::class, 'fileImport'])->name('importpayment');

        Route::get('import-creditnote', [CreditnoteController::class, 'importCreditnote']);
        Route::post('import-creditnote', [CreditnoteController::class, 'fileImport'])->name('importcreditnote');


});



Auth::routes();


//get api data
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('allmembers', [DatatablesController::class, 'getAllMembers'])->name('allmembers');
Route::get('currentmembers', [DatatablesController::class, 'currentMembers'])->name('currentmembers');
Route::get('pastMembers', [DatatablesController::class, 'pastMembers'])->name('pastmembers');
Route::get('getsahayak', [DatatablesController::class, 'getSahayak'])->name('getsahayak');
Route::get('getfullmember', [DatatablesController::class, 'getFullMember'])->name('getfullmember');
Route::get('getpaidupmember', [DatatablesController::class, 'getPaidUpMember'])->name('getpaidupmember');
Route::get('getmemberswithbalances', [DatatablesController::class, 'getMembersWithBalances'])->name('getmemberswithbalances');

//Route::get('testmembers', [DatatablesController::class, 'index'])->name('testmembers');




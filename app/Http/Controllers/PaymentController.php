<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Traits\MemberTrait;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{

    use MemberTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('member')
            ->with('paymode')
            ->oldest('pay_date', 'asc')
            ->paginate(10);
        return view('receipts.index', compact('payments'));
    }

    public function statement(Request $request)
    {
        //$request->member_id=2;
        $transactions = DB::table('members as T1')
                        ->leftjoin('payments as T2','T1.id','=','T2.member_id')
                        ->leftjoin('invoices as T3', 'T1.id','=','T3.member_id')
                        ->leftjoin('items as T4','T3.id','=','T4.invoice_id')
                        ->select('T1.fname','T1.lname','T2.pay_date','T2.amount as credit','T2.id','T4.amount as debit')
                        //->where('T1.id', '=',$request->member_id)
                        ->get();
        
        //Payment::with('member')
            //->with('paymode')
            //->with('invoice')
            //->oldest('pay_date', 'asc')
            //->paginate(10);
           //dd($transactions);
        return view('statements.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = $this->currentMembers();
        $paymodes = $this->modeOfPayment();

        return view('payment.create', compact(['members', 'paymodes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Payment::create($request->all());

        return redirect()->route('payment.index')->with('message', 'Payment saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('receipts.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

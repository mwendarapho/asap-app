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
        //$request->member_id = 29;
    
        $transactions = "select  docno, member_id,date,T5.fname,T5.lname,
                        sum(case when doctype = 'INV' then amount else 0 end) owed,
                        sum(case when doctype = 'RCT' then amount else 0 end) paid

                        from

                        (
                        select T1.id as docno,T1.member_id,T1.due_date as date, sum(T2.amount) as amount,'INV' as doctype
                        from invoices T1 join items T2 on T1.id=T2.invoice_id
                        group by T2.invoice_id

                        union all

                        select T3.id as docno,T3.member_id, T3.pay_date as date,  T3.amount,'RCT' as doctype
                        from payments T3

                        ) T4 
                        join members T5 on T4.member_id=T5.id

                        #WHERE T4.member_id=3
                        GROUP BY T4.docno,T4.member_id,T4.date";

        //dd($transactions);
        $transactions = DB::select(DB::raw($transactions));
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

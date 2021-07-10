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
//dd($request->member_id);
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $member_id = $request->member_id;

        // dd($balBF=$this->balanceBroughtForward('2021-06-01',29));

        $balBF = $this->balanceBroughtForward($from_date, $member_id);

        $transactions = "select  docno, member_id,date,T5.fname,T5.lname,
                        sum(case when doctype = 'INV' then amount else 0 end) owed,
                        sum(case when doctype = 'RCT' then amount else 0 end) paid
                        from
                        (
                        select T1.id as docno,T1.member_id,T1.due_date as date, sum(T2.qty*T2.amount) as amount,'INV' as doctype
                        from invoices T1 join items T2 on T1.id=T2.invoice_id
                        group by T2.invoice_id
                        union all
                        select T3.id as docno,T3.member_id, T3.pay_date as date,  T3.amount,'RCT' as doctype
                        from payments T3
                        ) T4
                        join members T5 on T4.member_id=T5.id";
        if ($request->member_id == 000) {

            $transaction1 = " WHERE date >= :from_date
                            and   date <= :to_date GROUP BY T4.docno";

            $transactions .= $transaction1;

        } else {
            $transaction1 = " WHERE T4.member_id=:member_id AND date >= :from_date
                            and   date <= :to_date GROUP BY T4.docno";

            $transactions .= $transaction1;
        }

        // DB::enableQueryLog();
        if ($member_id == 000) {
            $transactions = DB::select(DB::raw($transactions), ['to_date' => $to_date, 'from_date' => $from_date]);

        } else {
            $transactions = DB::select(DB::raw($transactions), ['to_date' => $to_date, 'from_date' => $from_date, 'member_id' => $member_id]);

        }
        // $log = DB::getQueryLog();
        //dump($log);


        return view('statements.index', compact(['transactions', 'balBF']));
    }

    public function statement1(Request $request)
    {
        $data = $request->all();

        //dd($request->all());
        //$balanceBF=$this->balanceBroughtForward($data['from_date'],$data['member_id']);

        $transactions = DB::table('invoices as T1')
            ->join('items as T2', 'T1.id', '=', 'T2.invoice_id')
            //->join('members as T3', 'T1.member_id', '=', 'T3.id')
            ->select('T1.id as docno', 'T2.amount', 'T1.member_id', 'T1.due_date as date')
            ->groupby('T2.invoice_id')
            //->sum('T2.amount');
            ->get();


        dd($transactions);
        $paymenttotal = DB::table('payments as T1')
            ->join('members as T2', 'T1.member_id', '=', 'T2.id')
            ->select('T1.id as docno', 'T1.member_id', 'T1.amount', 'T1.pay_date')
            //->union($transactions)
            ->get();
        //print_r($paymenttotal);
        return view('statements.index', compact(['transactions', 'balanceBF']));
        //$members = $this->currentMembers();
        // return view('statements.member_statement',compact('members'));

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
     * @param \Illuminate\Http\Request $request
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
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {


        return view('receipts.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function statement100(Request $request)
    {


        $data = $request->all();

        dd($data);


        // DB::enableQueryLog();

        dd($this->balanceBroughtForward($data['from_date'], $data['member_id']));
        //$log = DB::getQueryLog();
        //dump($log);

    }

    public function statementFilter()
    {
        $members = $this->allMembers();
        return view('statements.member_statement', compact('members'));

    }
}

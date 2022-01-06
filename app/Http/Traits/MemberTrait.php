<?php

namespace App\Http\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


trait MemberTrait
{
   
    public function currentMembers()
    {

        $data = DB::table('members')
            ->select('id', 'fname', 'lname')
            ->where('status', '=', true)
            ->orderBy('fname', 'asc')
            ->get();

        return $data;
    }

    public function allMembers()
    {

        $data = DB::table('members')
            ->select('id', 'fname', 'lname')
            ->orderBy('fname', 'asc')
            ->get();

        return $data;
    }


    public function modeOfPayment()
    {

        $data = DB::table('paymodes')
            ->select('id', 'name')
            //->where('status', '=', true)
            ->orderBy('name', 'asc')
            ->get();

        return $data;
    }


    public function balanceBroughtForward($date, $member_id)
    {
        //dd([$date,$member_id]);

        //DB::enableQueryLog();

        $invoicetotal = "select sum(T2.qty * T2.amount) as amount
                        from `invoices` as `T1`
                        inner join `items` as `T2` on `T1`.`id` = `T2`.`invoice_id`
                        where T1.due_date < :date ";

        if ($member_id != 000) {
            $transaction1 = "  and T1.member_id = :member_id";

            $invoicetotal .= $transaction1;
            $invoicetotal = DB::select(DB::raw($invoicetotal), ['date' => $date, 'member_id' => $member_id]);
        } else {
            $invoicetotal = DB::select(DB::raw($invoicetotal), ['date' => $date]);
        }


        $paymenttotal = "select sum(T4.amount) as amount
                        from (
                        select T1.amount, T1.pay_date as doc_date,member_id
                        from payments T1
                        union all
                        select T3.amount, T3.credit_date as doc_date,member_id
                        from creditnotes T3
                        ) T4
                        where doc_date< :date";

        if ($member_id != 000) {
            $transaction1 = "  and member_id = :member_id";

            $paymenttotal .= $transaction1;
            $paymenttotal = DB::select(DB::raw($paymenttotal), ['date' => $date, 'member_id' => $member_id]);
        } else {
            $paymenttotal = DB::select(DB::raw($paymenttotal), ['date' => $date]);
        }


         // $log = DB::getQueryLog();
         //dump($log);

        return ["credit" => ($paymenttotal[0]->amount) ?: 0, "debit" => ($invoicetotal[0]->amount) ?: 0];


    }

    public function memberBalances($date){
        $query="select T6.member_id,T6.fname,T6.lname,T6.mobile,T6.email,T6.category_id,T6.status,sum(credit+refund-debit) AS bal from
                    (
                        select  docno, member_id,date,T5.fname,T5.lname,T5.email,T5.mobile,T5.category_id,T5.status,
                          sum(case when doctype = 'INV' then amount else 0 end) debit,
                          sum(case when doctype = 'RCT' then amount else 0 end) credit,
                           sum(case when doctype = 'CRD' then amount else 0 end) refund

                        from

                        (
                        select T1.id as docno,T1.member_id,T1.due_date as date, sum(T2.qty*T2.amount) as amount,'INV' as doctype
                        from invoices T1 join items T2 on T1.id=T2.invoice_id
                        group by T2.invoice_id

                        union all

                        select T3.id as docno,T3.member_id, T3.pay_date as date,  T3.amount,'RCT' as doctype
                        from payments T3
                          union all
                           select T7.id as docno, T7.member_id,T7.credit_date as date, T7.amount, 'CRD' as doctype
                              from creditnotes T7

                          ) T4
                          join members T5 on T4.member_id=T5.id

                        WHERE  date < :date
                        GROUP BY docno,member_id,date
                    ) T6

                    group by member_id
                    ";
        return DB::select(DB::raw($query), ['date' => $date]);
    }

    public function statement($to_date, $member_id)
    {
        //$to_date=Carbon::parse($to_date)->subYear(1)->format('Y-m-d');
        $from_date =Carbon::parse($to_date)->subYear(3)->format('Y-m-d');
        
        //dd($from_date);

        //$dateRange=['to_date'=>$to_date,'from_date'=>$from_date];


         //dd($balBF=$this->balanceBroughtForward($from_date,$member_id));

        $balBF = $this->balanceBroughtForward($from_date, $member_id);

        $transactions = "select  docno, member_id,date,T7.fname,T7.lname,
                        sum(case when doctype = 'INV' then amount else 0 end) owed,
                        sum(case when doctype = 'RCT' then amount else 0 end) paid,
                        sum(case when doctype = 'CRD' then amount else 0 end) credit
                        from
                        (
                        select T1.id as docno,T1.member_id,T1.due_date as date, sum(T2.qty*T2.amount) as amount,'INV' as doctype
                        from invoices T1 join items T2 on T1.id=T2.invoice_id
                        group by T2.invoice_id
                        union all
                        select T3.id as docno,T3.member_id, T3.pay_date as date,  T3.amount,'RCT' as doctype
                        from payments T3
                        union all
                        select T5.id as docno, T5.member_id,T5.credit_date as date, T5.amount, 'CRD' as doctype
                        from creditnotes T5
                        ) T4
                        join members T7 on T4.member_id=T7.id";
        if ($member_id == 000) {

            $transaction1 = " WHERE date >= :from_date
                            and   date <= :to_date GROUP BY T4.docno,T4.member_id,T4.date order by T4.member_id, T4.date";

            $transactions .= $transaction1;

        } else {
            $transaction1 = " WHERE T4.member_id=:member_id AND date >= :from_date
                            and   date <= :to_date GROUP BY T4.docno order by T4.date";

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
        //dd($transactions);



        return view('statements.member_five_year_balance', compact(['transactions', 'balBF']));
    }


}

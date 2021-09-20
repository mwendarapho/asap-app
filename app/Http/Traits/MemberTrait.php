<?php

namespace App\Http\Traits;


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


    public function memberBalances($date, $member_id)
    {
        return $this->allMembers();
    }
}

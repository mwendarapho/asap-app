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


    public function balanceBroughtForward($date,$member_id)
    {
        DB::enableQueryLog();

        //$date = "2021-06-22";
        //$member_id = 29;

        $invoicetotal = DB::table('invoices as T1')
            ->join('items as T2', 'T1.id', '=', 'T2.invoice_id')
            ->join('members as T3', 'T1.member_id', '=', 'T3.id')
            ->select('T1.id as docno', 'T2.amount', 'T1.member_id', 'T1.due_date as date', 'T3.fname', 'T3.lname')


           // if($date) $invoicetotal->where('T1.due_date','<', $date);
            //if($member_id) $invoicetotal->where('T1.member_id','=', $member_id)


            ->where('T1.due_date', '<', $date)
            ->where('T1.member_id', '=', $member_id)
            ->sum('T2.amount');


        $paymenttotal = DB::table('payments as T1')
            ->join('members as T2', 'T1.member_id', '=', 'T2.id')
            ->where('T1.created_at', '<', $date)
            ->where('T2.id', '=', $member_id)
            ->sum('T1.amount');

        $log = DB::getQueryLog();
        dump($log);

        //return abs($paymenttotal-$invoicetotal);

        //$paymenttotal=0;
         return ["credit"=>$paymenttotal, "debit"=>$invoicetotal];


    }
}

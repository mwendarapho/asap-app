<?php

namespace App\Http\Traits;


use Illuminate\Support\Facades\DB;




trait MemberTrait{



public function currentMembers(){

$data = DB::table('members')
            ->select('id', 'fname', 'lname')
            ->where('status', '=', true)
            ->orderBy('fname', 'asc')
            ->get();

return $data;

}


public function modeOfPayment(){

    $data = DB::table('paymodes')
                ->select('id', 'name')
                //->where('status', '=', true)
                ->orderBy('name', 'asc')
                ->get();
    
    return $data;
    
    }


}
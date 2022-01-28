<?php

namespace App\Imports;

use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class PaymentImport implements ToCollection
{
  

    public function collection(Collection $rows)
    {
       
        foreach ($rows as $row) {

            if(strtoupper($row[5])=='P'){
                DB::transaction(function () use ($row) {
                    $data['member_id']=$row[0];
                    $data['pay_date']= Carbon::parse($row[1])->addDays(random_int(1,20))->format('Y-m-d');
                    $data['ref']='xxx';
                    $data['paymode_id']=5;
                    $data['amount']=2500;
                    
                    Payment::create($data);
                },3);

            }
                        
                

        }
    }
}

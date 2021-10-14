<?php

namespace App\Imports;

use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class PaymentImport implements ToCollection
{

    public function collection(Collection $rows)
    {

        $selected_data=[];
        foreach ($rows as $row) {
            if (strtoupper($row[5])=="P") {
               $data=[
                    'pay_date' => Carbon::parse($row[1])->addDays(random_int(1,28))->format('Y-m-d'),
                    'ref' => 'XXXX',
                    'paymode_id' => 5,
                    'member_id' => $row[0],
                    'amount' => 2500,
                ];
               array_push($selected_data,$data);

            }

        }
        Payment::insert($selected_data);
    }
}

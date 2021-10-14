<?php

namespace App\Imports;

use App\Models\Creditnote;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CreditnoteImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $selected_data=[];
        foreach ($collection as $row) {
            if (strtoupper($row[5])=="E") {
                $data=[
                    'credit_date' => Carbon::parse($row[1])->addDays(random_int(1,28))->format('Y-m-d'),
                    'credit_ref' => 'XXXX',
                    'invoice_id' => '',
                    'member_id' => $row[0],
                    'amount' => 2500,
                ];
                array_push($selected_data,$data);

            }

        }
        Creditnote::insert($selected_data);
    }
}

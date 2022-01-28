<?php

namespace App\Imports;

use App\Models\Creditnote;
use App\Models\Invoice;
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
            if ($row[5]=='E') {

                
                $invoice=Invoice::where('member_id','=',$row[0])
                        ->where('due_date', 'like','2015%')
                        ->get();
                       // dd($invoice);
                        
                    $id=$invoice[0]['id'];

                $data=[
                    'credit_date' => Carbon::parse($row[1])->addDays(random_int(21,27))->format('Y-m-d'),
                    'credit_ref' => 'XXXX',
                    'invoice_id' => $id,
                    'member_id' => $row[0],
                    'amount' => 2500,
                ];
                array_push($selected_data,$data);

            }

        }
       // dd($selected_data);
        Creditnote::insert($selected_data);
    }
}

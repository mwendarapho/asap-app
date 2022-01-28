<?php

namespace App\Imports;

use App\Models\Invoice;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;


class InvoicesImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
           // if($row[5]!='') {
                DB::transaction(function () use ($row) {
                    $data['member_id'] = $row[0];
                    $data['invoice_date'] = Carbon::parse($row[1])->format('Y-m-d');
                    $data['due_date'] =  Carbon::parse( $row[2])->format('Y-m-d');

                    $id = Invoice::create($data)->id;


                    $data['description'] = $row[3];
                    $data['qty'] = $row[4];
                    $data['amount'] = 2500;
                    $data['invoice_id'] = $id;
                    Item::create($data);
                }, 3);
            //}

        }

    }
}

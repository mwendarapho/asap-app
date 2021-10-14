<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;


class MembersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Member([

            'fname' => $row[0],
            'lname' => $row[1],
            'mobile' => $row[2],
            'address' => $row[3],
            'email' => $row[4],
            'dob' => $row[5],
            'spouse_name' => $row[6],
            'spouse_mobile' => $row[7],
            'joined_on' => $row[8],
            'left_on' => $row[9],
            'status' => 1,
            //'status'=>($row[10]!='')? false: true,
            'category_id'=>($row[11]=='S')? 1: 2,
        ]);
    }
}

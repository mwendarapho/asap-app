<?php

namespace Database\Seeders;

use App\Models\Paymode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Paymode::factory(1)->create();
        $modes=['Cash','M-pesa','Cheque','EFT','Other'];
        foreach ($modes as $mode){
            DB::table('paymodes')->insert([
                'name' =>$mode,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}

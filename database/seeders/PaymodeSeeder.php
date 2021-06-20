<?php

namespace Database\Seeders;

use App\Models\Paymode;
use Illuminate\Database\Seeder;

class PaymodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paymode::factory(7)->create();
    }
}

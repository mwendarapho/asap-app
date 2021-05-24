<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(MemberSeeder::class);
        $this->call(FeeSeeder::class);
        $this->call(SubscriptionSeeder::class);
        //$this->call(InvoiceSeeder::class);
    }
}

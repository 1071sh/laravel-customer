<?php

use Illuminate\Database\Seeder;

class CustomerLogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\CustomerLog', 120)->create();
    }
}

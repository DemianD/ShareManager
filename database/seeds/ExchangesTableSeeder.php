<?php

use Illuminate\Database\Seeder;

class ExhangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchange = \App\Exchange::create(['name' => 'NASDAQ']);

        $share = new \App\Share(['name' => 'Apple', 'symbol' => 'APPL']);

        $exchange->shares()->save($share);


    }
}

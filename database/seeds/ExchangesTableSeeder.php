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

        $share1 = new \App\Share(['name' => 'Apple', 'symbol' => 'AAPL', 'guruwatch' => '350015372']);
        $share2 = new \App\Share(['name' => 'Google', 'symbol' => 'GOOG', 'guruwatch' => '350186927']);

        $exchange->shares()->save($share1);
        $exchange->shares()->save($share2);


    }
}

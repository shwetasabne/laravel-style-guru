<?php

use Illuminate\Database\Seeder;

class OccassionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('occassions')->insert([
            'name' => 'Outdoors'
        ]);

        DB::table('occassions')->insert([
            'name' => 'Weddings'
        ]);

        DB::table('occassions')->insert([
            'name' => 'Parties'
        ]);

        DB::table('occassions')->insert([
            'name' => 'Office Wear'
        ]);

        DB::table('occassions')->insert([
            'name' => 'Casuals'
        ]);

        DB::table('occassions')->insert([
            'name' => 'Summer Wear'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Jewellery'
        ]);

        DB::table('categories')->insert([
            'name' => 'Bags'
        ]);

        DB::table('categories')->insert([
            'name' => 'Outer Wear'
        ]);

        DB::table('categories')->insert([
            'name' => 'Footwear'
        ]);

        DB::table('categories')->insert([
            'name' => 'Bottoms'
        ]);

        DB::table('categories')->insert([
            'name' => 'Tops'
        ]);
    }
}

<?php
use Illuminate\Database\Seeder;
use App\Model\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
//        User::truncate();
        foreach(range(1,30) as $index)
        {
            User::create([
                'first_name'    => $faker->firstName, 
                'last_name'     => $faker->lastName,
                'email'         => $faker->email,
                'password'      => bcrypt('password'),
                'university_id' => rand(1,148), 
            ]);
        }
    
    }
}
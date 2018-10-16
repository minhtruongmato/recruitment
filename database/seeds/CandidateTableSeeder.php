<?php

use Illuminate\Database\Seeder;

class CandidateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidates')->insert([
        	'user_id' => 24,
            'name' => str_random(10),
            'title' => str_random(10),
            'gender' => rand(0, 1),
            'address' => str_random(10),
            'phone' => rand(111111111, 999999999),
            'birthday' => date('Y-m-d'),
            'marital' => rand(0, 1),
            'time_to_work' => str_random(10),
            'rating' => rand(0, 5),
            'experience' => str_random(10),
            'education' => str_random(10),
            'location' => str_random(10),
            'wage' => str_random(10),
            'workplace' => str_random(10),
            'language' => str_random(10),
            'desired_job' => str_random(10),
            'field' => str_random(10),
            'skill' => str_random(10),
            'work_experience' => str_random(10),
            'content' => str_random(100),
            'email' => str_random(10).'@gmail.com',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        'name'  => 'Khaeruddin Asdar',
	        'email' => 'khaeruddinasdar12@gmail.com',
	        'password'  => bcrypt('12345678'),
	        'jabatan' => 'sekum',
	        'phone' => '082123123123',
	        'noreg' => '829.K',
            'email_verified_at' => '2020-04-17 11:42:45.000000'
		]);
    }
}

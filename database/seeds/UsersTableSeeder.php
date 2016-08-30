<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 28,
                'name' => 'demo',
                'email' => 'demo@demo.demo',
                'password' => '$2y$10$sBJGxzjjReXCBKNK5MVEm.jR1jJu3MqhRqfoJv9Szusj65mRBYbTe',
                'remember_token' => '6eQimIBYIyIipcY3s2pZq02xTOien5SEtoWumO5ucPeP02tdNUjfLAXhMBYS',
                'created_at' => '1977-01-14 00:12:56',
                'updated_at' => '2016-07-11 18:11:21',
            ),
        ));
        
        
    }
}

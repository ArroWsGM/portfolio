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
                'id' => 27,
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => '$2y$10$CB4u5OgBE2KcOXjP.Pc1I.wI3isTJCnc00IPZbSk/f6svYKOf9OVq',
                'remember_token' => 'CCFI0Ya4bDLzYCYjvaqNFTAu8W1jqTE47QvusZvv5R0dIqEeIs0OTz3zHxkH',
                'created_at' => '1986-03-22 04:02:26',
                'updated_at' => '2016-07-11 18:10:34',
            ),
            1 => 
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

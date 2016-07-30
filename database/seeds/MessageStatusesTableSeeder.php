<?php

use Illuminate\Database\Seeder;

class MessageStatusesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('message_statuses')->delete();
        
        \DB::table('message_statuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'status_name' => 'New',
                'status_class' => 'bg-danger',
            ),
            1 => 
            array (
                'id' => 2,
                'status_name' => 'Viewed',
                'status_class' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'status_name' => 'Answered',
                'status_class' => 'bg-success',
            ),
        ));
        
        
    }
}

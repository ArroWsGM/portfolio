<?php

use Illuminate\Database\Seeder;

class ProjectPropertiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('project_properties')->delete();
        
        \DB::table('project_properties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 1,
                'property_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 13,
                'project_id' => 22,
                'property_id' => 1,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            2 => 
            array (
                'id' => 14,
                'project_id' => 22,
                'property_id' => 4,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            3 => 
            array (
                'id' => 15,
                'project_id' => 22,
                'property_id' => 5,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            4 => 
            array (
                'id' => 16,
                'project_id' => 22,
                'property_id' => 6,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            5 => 
            array (
                'id' => 17,
                'project_id' => 22,
                'property_id' => 8,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            6 => 
            array (
                'id' => 18,
                'project_id' => 22,
                'property_id' => 13,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            7 => 
            array (
                'id' => 19,
                'project_id' => 22,
                'property_id' => 16,
                'created_at' => '2016-07-01 16:24:28',
                'updated_at' => '2016-07-01 16:24:28',
            ),
            8 => 
            array (
                'id' => 22,
                'project_id' => 1,
                'property_id' => 4,
                'created_at' => '2016-07-02 13:54:04',
                'updated_at' => '2016-07-02 13:54:04',
            ),
            9 => 
            array (
                'id' => 23,
                'project_id' => 1,
                'property_id' => 5,
                'created_at' => '2016-07-02 13:54:45',
                'updated_at' => '2016-07-02 13:54:45',
            ),
            10 => 
            array (
                'id' => 24,
                'project_id' => 1,
                'property_id' => 6,
                'created_at' => '2016-07-02 13:54:45',
                'updated_at' => '2016-07-02 13:54:45',
            ),
            11 => 
            array (
                'id' => 31,
                'project_id' => 1,
                'property_id' => 12,
                'created_at' => '2016-07-06 11:34:40',
                'updated_at' => '2016-07-06 11:34:40',
            ),
            12 => 
            array (
                'id' => 32,
                'project_id' => 10,
                'property_id' => 1,
                'created_at' => '2016-07-06 12:23:44',
                'updated_at' => '2016-07-06 12:23:44',
            ),
            13 => 
            array (
                'id' => 33,
                'project_id' => 10,
                'property_id' => 4,
                'created_at' => '2016-07-06 12:23:50',
                'updated_at' => '2016-07-06 12:23:50',
            ),
            14 => 
            array (
                'id' => 35,
                'project_id' => 23,
                'property_id' => 1,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            15 => 
            array (
                'id' => 36,
                'project_id' => 23,
                'property_id' => 4,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            16 => 
            array (
                'id' => 37,
                'project_id' => 23,
                'property_id' => 5,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            17 => 
            array (
                'id' => 38,
                'project_id' => 23,
                'property_id' => 7,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            18 => 
            array (
                'id' => 39,
                'project_id' => 23,
                'property_id' => 8,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            19 => 
            array (
                'id' => 40,
                'project_id' => 23,
                'property_id' => 12,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            20 => 
            array (
                'id' => 41,
                'project_id' => 23,
                'property_id' => 14,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            21 => 
            array (
                'id' => 42,
                'project_id' => 23,
                'property_id' => 16,
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            22 => 
            array (
                'id' => 43,
                'project_id' => 24,
                'property_id' => 1,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            23 => 
            array (
                'id' => 44,
                'project_id' => 24,
                'property_id' => 2,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            24 => 
            array (
                'id' => 45,
                'project_id' => 24,
                'property_id' => 4,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            25 => 
            array (
                'id' => 46,
                'project_id' => 24,
                'property_id' => 5,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            26 => 
            array (
                'id' => 47,
                'project_id' => 24,
                'property_id' => 7,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            27 => 
            array (
                'id' => 48,
                'project_id' => 24,
                'property_id' => 9,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            28 => 
            array (
                'id' => 49,
                'project_id' => 24,
                'property_id' => 10,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            29 => 
            array (
                'id' => 50,
                'project_id' => 24,
                'property_id' => 13,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            30 => 
            array (
                'id' => 51,
                'project_id' => 24,
                'property_id' => 14,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            31 => 
            array (
                'id' => 52,
                'project_id' => 24,
                'property_id' => 16,
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            32 => 
            array (
                'id' => 63,
                'project_id' => 1,
                'property_id' => 7,
                'created_at' => '2016-07-11 17:53:55',
                'updated_at' => '2016-07-11 17:53:55',
            ),
            33 => 
            array (
                'id' => 65,
                'project_id' => 1,
                'property_id' => 16,
                'created_at' => '2016-07-11 17:53:55',
                'updated_at' => '2016-07-11 17:53:55',
            ),
        ));
        
        
    }
}

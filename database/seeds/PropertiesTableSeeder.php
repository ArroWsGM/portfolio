<?php

use Illuminate\Database\Seeder;

class PropertiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('properties')->delete();
        
        \DB::table('properties')->insert(array (
            0 => 
            array (
                'id' => 1,
                'property_name' => 'Mobile',
                'property_class' => 'fa fa-mobile',
                'property_group' => 'device',
            ),
            1 => 
            array (
                'id' => 2,
                'property_name' => 'Tablet',
                'property_class' => 'fa fa-tablet',
                'property_group' => 'device',
            ),
            2 => 
            array (
                'id' => 4,
                'property_name' => 'Desktop',
                'property_class' => 'fa fa-desktop',
                'property_group' => 'device',
            ),
            3 => 
            array (
                'id' => 5,
                'property_name' => 'Chrome',
                'property_class' => 'fa fa-chrome',
                'property_group' => 'browser',
            ),
            4 => 
            array (
                'id' => 6,
                'property_name' => 'IE Edge',
                'property_class' => 'fa fa-edge',
                'property_group' => 'browser',
            ),
            5 => 
            array (
                'id' => 7,
                'property_name' => 'Internet Explorer',
                'property_class' => 'fa fa-internet-explorer',
                'property_group' => 'browser',
            ),
            6 => 
            array (
                'id' => 8,
                'property_name' => 'Firefox',
                'property_class' => 'fa fa-firefox',
                'property_group' => 'browser',
            ),
            7 => 
            array (
                'id' => 9,
                'property_name' => 'Safari',
                'property_class' => 'fa fa-safari',
                'property_group' => 'browser',
            ),
            8 => 
            array (
                'id' => 10,
                'property_name' => 'Opera',
                'property_class' => 'fa fa-opera',
                'property_group' => 'browser',
            ),
            9 => 
            array (
                'id' => 11,
                'property_name' => 'Vivaldi',
                'property_class' => 'arricon arricon-vivaldi',
                'property_group' => 'browser',
            ),
            10 => 
            array (
                'id' => 12,
                'property_name' => 'Laravel',
                'property_class' => 'arricon arricon-laravel',
                'property_group' => 'technology',
            ),
            11 => 
            array (
                'id' => 13,
                'property_name' => 'CodeIgniter',
                'property_class' => 'arricon arricon-ci',
                'property_group' => 'technology',
            ),
            12 => 
            array (
                'id' => 14,
                'property_name' => 'GitHub',
                'property_class' => 'fa fa-github',
                'property_group' => 'technology',
            ),
            13 => 
            array (
                'id' => 16,
                'property_name' => 'HTML5',
                'property_class' => 'fa fa-html5',
                'property_group' => 'technology',
            ),
        ));
        
        
    }
}

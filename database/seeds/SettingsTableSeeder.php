<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'setting_name' => 'sitename',
                'setting_value' => 'Portfolio',
                'setting_type' => 'string',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'setting_name' => 'powered_by_link',
                'setting_value' => 'https://laravel.com/',
                'setting_type' => 'string',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'setting_name' => 'per_page_admin',
                'setting_value' => '10',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'setting_name' => 'imgsz_mini_width',
                'setting_value' => '60',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'setting_name' => 'imgsz_mini_height',
                'setting_value' => '45',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'setting_name' => 'imgsz_thumb_width',
                'setting_value' => '500',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'setting_name' => 'imgsz_thumb_height',
                'setting_value' => '500',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'setting_name' => 'imgsz_small_width',
                'setting_value' => '600',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'setting_name' => 'imgsz_small_height',
                'setting_value' => '375',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'setting_name' => 'imgsz_medium_width',
                'setting_value' => '1280',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'setting_name' => 'imgsz_medium_height',
                'setting_value' => '800',
                'setting_type' => 'int',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'setting_name' => 'img_placeholder',
                'setting_value' => 'http://placehold.it/500/ff0000/ffffff?text=No+Image+Available',
                'setting_type' => 'string',
                'created_at' => '2016-07-04 16:50:31',
                'updated_at' => '2016-07-05 20:26:29',
            ),
            12 => 
            array (
                'id' => 13,
                'setting_name' => 'img_videoposter',
                'setting_value' => 'http://placehold.it/1280x720/ff0000/ffffff?text=No+Video+Placeholder',
                'setting_type' => 'string',
                'created_at' => '2016-07-06 09:25:12',
                'updated_at' => '2016-07-06 09:25:12',
            ),
            13 => 
            array (
                'id' => 14,
                'setting_name' => 'img_projectplaceholder',
                'setting_value' => 'http://placehold.it/1280x800/ff0000/ffffff?text=No+Image+Available',
                'setting_type' => 'string',
                'created_at' => '2016-07-06 09:36:51',
                'updated_at' => '2016-07-06 09:36:51',
            ),
            14 => 
            array (
                'id' => 15,
                'setting_name' => 'email_admin',
                'setting_value' => 'mikulov-ya@yandex.ru',
                'setting_type' => 'string',
                'created_at' => '2016-07-07 14:34:28',
                'updated_at' => '2016-07-07 14:34:28',
            ),
            15 => 
            array (
                'id' => 16,
                'setting_name' => 'email_message_resend',
                'setting_value' => '1',
                'setting_type' => 'bool',
                'created_at' => '2016-07-07 14:34:57',
                'updated_at' => '2016-07-11 14:19:25',
            ),
            16 => 
            array (
                'id' => 17,
                'setting_name' => 'email_signature',
                'setting_value' => '<ul style="list-style:none;color:#888;"><li>--</li><li>С уважением,</li><li>Витвицкий Евгений</li><li><a href="mailto:ArroWs.GM@gmail.com">ArroWs.GM@gmail.com</a></li><li>skype: ArroWs.GM</li><li><a href="tel:+380931396533">+380 93 139 65 33</a></li></ul>',
                'setting_type' => 'string',
                'created_at' => '2016-07-08 23:00:46',
                'updated_at' => '2016-07-08 23:04:31',
            ),
            17 => 
            array (
                'id' => 19,
                'setting_name' => 'front_carouselitems',
                'setting_value' => '5',
                'setting_type' => 'int',
                'created_at' => '2016-07-11 14:30:39',
                'updated_at' => '2016-07-11 14:30:39',
            ),
        ));
        
        
    }
}

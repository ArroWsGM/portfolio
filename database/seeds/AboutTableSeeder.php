<?php

use Illuminate\Database\Seeder;

class AboutTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('about')->delete();
        
        \DB::table('about')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cms_name' => 'Valery CMS',
                'cms_version' => '2.0.0b',
                'cms_build' => 'Lonesome Rider',
                'cms_promo' => 'https://www.youtube.com/embed/7WdO9KhcUKE',
            ),
        ));
        
        
    }
}

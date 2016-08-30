<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AboutTableSeeder::class);
        //$this->call(UsersTableSeeder::class);
        //$this->call(SettingsTableSeeder::class);
        
	    #iseed_start

	    $this->call('UsersTableSeeder');
	    $this->call('AboutTableSeeder');
        $this->call('GalleriesTableSeeder');
        $this->call('MessagesTableSeeder');
        $this->call('MessageStatusesTableSeeder');
        $this->call('ProjectsTableSeeder');
        $this->call('ProjectPropertiesTableSeeder');
        $this->call('PropertiesTableSeeder');
        $this->call('SettingsTableSeeder');
        #iseed_end
    }
}
/*
class AboutTableSeeder extends Seeder {

    public function run()
    {
        DB::table('about')->delete();
        DB::table('about')->insert([
        								'cms_name'		=> 'Valery CMS',
        								'cms_version'	=> '2.1.0',
        								'cms_build'		=> 'Lonesome Rider',
        								'cms_promo'		=> 'https://www.youtube.com/embed/7WdO9KhcUKE'
        							]);
    }

}

class UsersTableSeeder extends Seeder {

    public function run()
    {
		$faker = Faker::create();

        DB::table('users')->delete();
		DB::table('users')->insert([
							            'name' => 'admin',
							            'email' => 'admin@example.com',
							            'password' => bcrypt('test'),
								        'created_at' => $faker->dateTime,
		        ]);
		DB::table('users')->insert([
							            'name' => 'demo',
							            'email' => 'demo@demo.demo',
							            'password' => bcrypt('demo'),
								        'created_at' => $faker->dateTime,
		        ]);


		foreach(range(1,8) as $index)
		{
			DB::table('users')->insert([
								            'name' => $faker->userName,
								            'email' => $faker->email,
								            'password' => bcrypt('test'),
								            'created_at' => $faker->dateTime,
			        ]);
		}
    }

}

class SettingsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('settings')->delete();
		DB::table('settings')->insert([
							            ['setting_name' => 'sitename',
							            'setting_value' => 'Portfolio',
							            'setting_type' => 'string'],
							            ['setting_name' => 'powered_by_link',
							            'setting_value' => 'https://laravel.com/',
							            'setting_type' => 'string'],
							            ['setting_name' => 'per_page_admin',
							            'setting_value' => '10',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_mini_width',
							            'setting_value' => '60',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_mini_height',
							            'setting_value' => '45',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_thumb_width',
							            'setting_value' => '500',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_thumb_height',
							            'setting_value' => '500',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_small_width',
							            'setting_value' => '600',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_small_height',
							            'setting_value' => '375',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_medium_width',
							            'setting_value' => '1280',
							            'setting_type' => 'int'],
							            ['setting_name' => 'imgsz_medium_height',
							            'setting_value' => '800',
							            'setting_type' => 'int'],
		        ]);
    }
}
*/
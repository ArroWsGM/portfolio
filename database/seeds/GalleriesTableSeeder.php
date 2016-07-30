<?php

use Illuminate\Database\Seeder;

class GalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galleries')->delete();
        
        \DB::table('galleries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'project_id' => 2,
                'item_type' => 'img',
                'item_url' => '/upload/enulla-ent-nuncves-consequa-rproin-faucibus-diampr-justov-commodo-ris-facilis/image_1467191157_vLu3sTtm.jpeg',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-06-29 09:05:58',
                'updated_at' => '2016-06-29 09:05:58',
            ),
            1 => 
            array (
                'id' => 2,
                'project_id' => 3,
                'item_type' => 'video',
                'item_url' => '/upload/ndisse-laut-asin-pretium-estmae-sceler-interdum-suspendi-tempusp-imperd-lorem/video_1467191306_rJzogU9M.mp4',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-06-29 09:08:27',
                'updated_at' => '2016-06-29 09:08:27',
            ),
            2 => 
            array (
                'id' => 3,
                'project_id' => 4,
                'item_type' => 'video_embed',
                'item_url' => NULL,
                'item_alt' => NULL,
                'item_embed' => '<iframe width="854" height="480" src="https://www.youtube.com/embed/-2Y4t9elm_A" frameborder="0" allowfullscreen></iframe>',
                'created_at' => '2016-06-29 09:13:40',
                'updated_at' => '2016-06-29 09:13:40',
            ),
            3 => 
            array (
                'id' => 4,
                'project_id' => 18,
                'item_type' => 'img',
                'item_url' => '/upload/loremin-sisut-oin-ris-feugiatm-iquam-uis-esque-iam-que-eunulla/image_1467195484_xsQADnAu.jpeg',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-06-29 10:18:05',
                'updated_at' => '2016-06-29 10:18:05',
            ),
            4 => 
            array (
                'id' => 9,
                'project_id' => 2,
                'item_type' => 'img',
                'item_url' => '/upload/enulla-ent-nuncves-consequa-rproin-faucibus-diampr-justov-commodo-ris-facilis/image_1467198587_IuKl84pB.jpeg',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-06-29 11:09:48',
                'updated_at' => '2016-06-29 11:09:48',
            ),
            5 => 
            array (
                'id' => 10,
                'project_id' => 19,
                'item_type' => 'video',
                'item_url' => '/upload/some-nice-seo-name/video_1467204277_UDzODK0w.mp4',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-06-29 12:44:37',
                'updated_at' => '2016-06-29 12:44:37',
            ),
            6 => 
            array (
                'id' => 11,
                'project_id' => 1,
                'item_type' => 'video',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/video_1467469197_iiklN0Tb.mp4',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-07-02 14:19:57',
                'updated_at' => '2016-07-02 14:19:57',
            ),
            7 => 
            array (
                'id' => 12,
                'project_id' => 22,
                'item_type' => 'img',
                'item_url' => '/upload/novyy-proekt-22/image_1467653084_tHtRssQ8.jpeg',
                'item_alt' => NULL,
                'item_embed' => '',
                'created_at' => '2016-07-04 17:24:45',
                'updated_at' => '2016-07-04 17:24:45',
            ),
            8 => 
            array (
                'id' => 14,
                'project_id' => 1,
                'item_type' => 'img',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/image_1467738843_lZxHIAUN.jpeg',
                'item_alt' => 'Onec hendrer roin bibendum cursusve lisis magnaqu oin laoreet dapibus.',
                'item_embed' => '',
                'created_at' => '2016-07-05 17:14:04',
                'updated_at' => '2016-07-05 17:14:04',
            ),
            9 => 
            array (
                'id' => 15,
                'project_id' => 1,
                'item_type' => 'img',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/image_1467738856_K1wPJqO6.jpeg',
                'item_alt' => 'Inproin lacusnam eratphas aenean semnunc pretiu ipsum sedin sem ullamco.',
                'item_embed' => '',
                'created_at' => '2016-07-05 17:14:16',
                'updated_at' => '2016-07-05 17:14:16',
            ),
            10 => 
            array (
                'id' => 17,
                'project_id' => 1,
                'item_type' => 'img',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/image_1467747156_bbQTNdW9.jpeg',
                'item_alt' => 'Donbass',
                'item_embed' => '',
                'created_at' => '2016-07-05 19:32:37',
                'updated_at' => '2016-07-05 19:32:37',
            ),
            11 => 
            array (
                'id' => 18,
                'project_id' => 10,
                'item_type' => 'video',
                'item_url' => '/upload/bulum-mattis-odio-amus-cursus-arcucura-liquam-maurisve-semmaec-eleifend-morbi/video_1467797445_TmnOQk5G.mp4',
                'item_alt' => '',
                'item_embed' => '',
                'created_at' => '2016-07-06 09:30:45',
                'updated_at' => '2016-07-06 09:30:45',
            ),
            12 => 
            array (
                'id' => 19,
                'project_id' => 1,
                'item_type' => 'video',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/video_1467797997_uxenMixF.mp4',
                'item_alt' => '',
                'item_embed' => '',
                'created_at' => '2016-07-06 09:39:57',
                'updated_at' => '2016-07-06 09:39:57',
            ),
            13 => 
            array (
                'id' => 20,
                'project_id' => 1,
                'item_type' => 'video',
                'item_url' => '/upload/aenean-congue-isised-maecenas-iumsed-velitsed-sollici-integer-nequenu-eu-varius/video_1467798027_sLiMxhxn.mp4',
                'item_alt' => '',
                'item_embed' => '',
                'created_at' => '2016-07-06 09:40:27',
                'updated_at' => '2016-07-06 09:40:27',
            ),
            14 => 
            array (
                'id' => 23,
                'project_id' => 23,
                'item_type' => 'video_embed',
                'item_url' => NULL,
                'item_alt' => '',
                'item_embed' => '<iframe width="854" height="480" src="https://www.youtube.com/embed/eUMwFaXTM3s" frameborder="0" allowfullscreen></iframe>',
                'created_at' => '2016-07-06 14:51:38',
                'updated_at' => '2016-07-06 14:51:38',
            ),
            15 => 
            array (
                'id' => 24,
                'project_id' => 23,
                'item_type' => 'img',
                'item_url' => '/upload/test-s-yutub/image_1467816729_x7xYHPci.jpeg',
                'item_alt' => 'Suspendi hac litora quam imperdie orciut ris fames nean ligulam.',
                'item_embed' => '',
                'created_at' => '2016-07-06 14:52:10',
                'updated_at' => '2016-07-06 14:52:10',
            ),
            16 => 
            array (
                'id' => 25,
                'project_id' => 24,
                'item_type' => 'img',
                'item_url' => '/upload/test-bez/image_1467816863_CbGWAVCl.jpeg',
                'item_alt' => 'Ullam teger mussed temporin vulput necinte sduis dui mauris orciut.',
                'item_embed' => '',
                'created_at' => '2016-07-06 14:54:24',
                'updated_at' => '2016-07-06 14:54:24',
            ),
            17 => 
            array (
                'id' => 26,
                'project_id' => 24,
                'item_type' => 'video',
                'item_url' => '/upload/test-bez/video_1467816912_xb0AygyH.mp4',
                'item_alt' => '',
                'item_embed' => '',
                'created_at' => '2016-07-06 14:55:12',
                'updated_at' => '2016-07-06 14:55:12',
            ),
        ));
        
        
    }
}

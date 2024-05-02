<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSpeakersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_speakers')->delete();
        
        \DB::table('user_speakers')->insert(array (
            0 => 
            array (
                'id' => 4,
                'user_id' => 8,
                'type_speaker' => 'Animateur',
                'biographie' => 'Ex tempore alias eu',
                'faceboock' => 'https://www.facebook.com/',
                'linkdin' => 'https://www.linkedin.com/',
                'instagram' => 'https://www.instagram.com/',
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:01:21',
                'updated_at' => '2024-04-29 10:17:54',
            ),
            /* 1 => 
            array (
                'id' => 5,
                'user_id' => 9,
                'type_speaker' => 'Animateur',
                'biographie' => 'Voluptatem Assumend',
                'faceboock' => 'https://www.facebook.com/',
                'linkdin' => 'https://www.linkedin.com/',
                'instagram' => 'https://www.instagram.com/',
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:02:12',
                'updated_at' => '2024-04-27 17:31:22',
            ),
            2 => 
            array (
                'id' => 6,
                'user_id' => 10,
                'type_speaker' => 'Conférencier',
                'biographie' => 'Sunt in ut et aliqua',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:02:46',
                'updated_at' => '2024-04-27 17:02:46',
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 11,
                'type_speaker' => 'Animateur',
                'biographie' => 'Quibusdam labore qui',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:03:27',
                'updated_at' => '2024-04-27 17:03:27',
            ),
            4 => 
            array (
                'id' => 8,
                'user_id' => 12,
                'type_speaker' => 'Animateur',
                'biographie' => 'dddddddddddddddddddddddddddddddddddddd',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:04:21',
                'updated_at' => '2024-04-27 17:04:21',
            ),
            5 => 
            array (
                'id' => 9,
                'user_id' => 13,
                'type_speaker' => 'Conférencier',
                'biographie' => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:07:39',
                'updated_at' => '2024-04-27 17:07:39',
            ),
            6 => 
            array (
                'id' => 10,
                'user_id' => 14,
                'type_speaker' => 'Conférencier',
                'biographie' => 'Nesciunt neque cons',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:10:10',
                'updated_at' => '2024-04-27 17:10:10',
            ),
            7 => 
            array (
                'id' => 11,
                'user_id' => 15,
                'type_speaker' => 'Formateur',
                'biographie' => 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:11:20',
                'updated_at' => '2024-04-27 17:11:20',
            ),
            8 => 
            array (
                'id' => 12,
                'user_id' => 16,
                'type_speaker' => 'Modérateur',
                'biographie' => 'Explicabo Id labor',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:11:57',
                'updated_at' => '2024-04-27 17:11:57',
            ),
            9 => 
            array (
                'id' => 13,
                'user_id' => 17,
                'type_speaker' => 'Formateur',
                'biographie' => 'Sunt debitis quis p',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:12:27',
                'updated_at' => '2024-04-27 17:12:27',
            ),
            10 => 
            array (
                'id' => 14,
                'user_id' => 18,
                'type_speaker' => 'Invité',
                'biographie' => 'Ut et sapiente dicta',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:13:23',
                'updated_at' => '2024-04-27 17:13:23',
            ),
            11 => 
            array (
                'id' => 15,
                'user_id' => 19,
                'type_speaker' => 'Formateur',
                'biographie' => 'Illo corporis animi',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:14:11',
                'updated_at' => '2024-04-27 17:14:11',
            ),
            12 => 
            array (
                'id' => 16,
                'user_id' => 20,
                'type_speaker' => 'Invité',
                'biographie' => 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:14:54',
                'updated_at' => '2024-04-27 17:14:54',
            ),
            13 => 
            array (
                'id' => 17,
                'user_id' => 21,
                'type_speaker' => 'Invité',
                'biographie' => 'Ut assumenda debitis',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:15:45',
                'updated_at' => '2024-04-27 17:15:45',
            ),
            14 => 
            array (
                'id' => 18,
                'user_id' => 22,
                'type_speaker' => 'Modérateur',
                'biographie' => 'Est a asperiores et',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:16:10',
                'updated_at' => '2024-04-27 17:16:10',
            ),
            15 => 
            array (
                'id' => 19,
                'user_id' => 23,
                'type_speaker' => 'Modérateur',
                'biographie' => 'Eu anim cupidatat es',
                'faceboock' => NULL,
                'linkdin' => NULL,
                'instagram' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:16:41',
                'updated_at' => '2024-04-27 17:16:41',
            ), */
        ));
        
        
    }
}
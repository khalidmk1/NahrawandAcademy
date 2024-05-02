<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_roles')->delete();
        
        \DB::table('user_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'role_id' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 16:26:55',
                'updated_at' => '2024-04-27 16:26:55',
            ),
           /*  1 => 
            array (
                'id' => 2,
                'user_id' => 2,
                'role_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 16:33:42',
                'updated_at' => '2024-04-27 16:33:42',
            ),
            2 => 
            array (
                'id' => 6,
                'user_id' => 6,
                'role_id' => 2,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 16:50:51',
                'updated_at' => '2024-04-27 16:50:51',
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 7,
                'role_id' => 5,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 16:57:19',
                'updated_at' => '2024-04-27 16:57:19',
            ),
            4 => 
            array (
                'id' => 8,
                'user_id' => 8,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:01:21',
                'updated_at' => '2024-04-27 17:01:21',
            ),
            5 => 
            array (
                'id' => 9,
                'user_id' => 9,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:02:12',
                'updated_at' => '2024-04-27 17:02:12',
            ),
            6 => 
            array (
                'id' => 10,
                'user_id' => 10,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:02:46',
                'updated_at' => '2024-04-27 17:02:46',
            ),
            7 => 
            array (
                'id' => 11,
                'user_id' => 11,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:03:27',
                'updated_at' => '2024-04-27 17:03:27',
            ),
            8 => 
            array (
                'id' => 12,
                'user_id' => 12,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:04:21',
                'updated_at' => '2024-04-27 17:04:21',
            ),
            9 => 
            array (
                'id' => 13,
                'user_id' => 13,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:07:39',
                'updated_at' => '2024-04-27 17:07:39',
            ),
            10 => 
            array (
                'id' => 14,
                'user_id' => 14,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:10:10',
                'updated_at' => '2024-04-27 17:10:10',
            ),
            11 => 
            array (
                'id' => 15,
                'user_id' => 15,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:11:20',
                'updated_at' => '2024-04-27 17:11:20',
            ),
            12 => 
            array (
                'id' => 16,
                'user_id' => 16,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:11:57',
                'updated_at' => '2024-04-27 17:11:57',
            ),
            13 => 
            array (
                'id' => 17,
                'user_id' => 17,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:12:27',
                'updated_at' => '2024-04-27 17:12:27',
            ),
            14 => 
            array (
                'id' => 18,
                'user_id' => 18,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:13:23',
                'updated_at' => '2024-04-27 17:13:23',
            ),
            15 => 
            array (
                'id' => 19,
                'user_id' => 19,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:14:11',
                'updated_at' => '2024-04-27 17:14:11',
            ),
            16 => 
            array (
                'id' => 20,
                'user_id' => 20,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:14:54',
                'updated_at' => '2024-04-27 17:14:54',
            ),
            17 => 
            array (
                'id' => 21,
                'user_id' => 21,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:15:45',
                'updated_at' => '2024-04-27 17:15:45',
            ),
            18 => 
            array (
                'id' => 22,
                'user_id' => 22,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:16:10',
                'updated_at' => '2024-04-27 17:16:10',
            ),
            19 => 
            array (
                'id' => 23,
                'user_id' => 23,
                'role_id' => 3,
                'deleted_at' => NULL,
                'created_at' => '2024-04-27 17:16:41',
                'updated_at' => '2024-04-27 17:16:41',
            ),
            20 => 
            array (
                'id' => 24,
                'user_id' => 24,
                'role_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2024-04-29 08:30:08',
                'updated_at' => '2024-04-29 08:30:08',
            ),
            21 => 
            array (
                'id' => 25,
                'user_id' => 25,
                'role_id' => 4,
                'deleted_at' => NULL,
                'created_at' => '2024-04-29 11:21:36',
                'updated_at' => '2024-04-29 11:21:36',
            ), */
        ));
        
        
    }
}
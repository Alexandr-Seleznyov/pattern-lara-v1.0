<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $array = $this->getArray();

        DB::table('users')->insert($array);
    }




    private function getArray()
    {
        $result = [];

        $result[] = [
            'id' => 1,
            'name' => 'SuperAdmin',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('111111'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 2,
            'name' => 'Admin',
            'email' => 'admin_2@admin.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('111111'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 3,
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('111111'),
            'remember_token' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        for($i = 0; $i < 20; $i++){
            $result[] = [
                'id' => $i + 4,
                'name' => 'User - '. $i,
                'email' => 'user'. $i .'@user.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('111111'),
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return $result;
    }

}

<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UsersRolesTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $array = $this->getArray();

        DB::table('users_roles')->insert($array);
    }




    private function getArray()
    {
        $result = [];

        $result[] = [
            'id' => 1,
            'users_id' => 1,
            'roles_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 2,
            'users_id' => 2,
            'roles_id' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 3,
            'users_id' => 3,
            'roles_id' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $result;
    }

}

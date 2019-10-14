<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class RolesTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $array = $this->getArray();

        DB::table('roles')->insert($array);
    }




    private function getArray()
    {
        $result = [];

        $result[] = [
            'id' => 1,
            'title' => 'Super Admin',
            'description' => 'All. Impossible to be banned',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 2,
            'title' => 'Admin',
            'description' => 'All',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 3,
            'title' => 'User',
            'description' => 'Only front',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 4,
            'title' => 'Content',
            'description' => 'Back. Only content.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $result[] = [
            'id' => 5,
            'title' => 'Banned',
            'description' => 'Nothing',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        return $result;
    }

}

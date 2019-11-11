<?php

use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class UsersDetailTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $array = $this->getArray();

        DB::table('users_details')->insert($array);
    }




    private function getArray()
    {
        $result = [];
        $gender = ['male', 'female'];

        $users = User::get();
        $i = 0;

        foreach($users as $value){
            $i++;
            $result[] = [
                'id' => $i,
                'users_id' => $value->id,
                'last_name' => 'last_name-'.$value->id,
                'patronymic' => 'patronymic-'.$value->id,
                'gender' => $gender[random_int(0,1)],
                'date_birthday' => $this->randomDate(),
                'phone' => '097111111'.$value->id,

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        return $result;
    }



    private function randomDate()
    {
        $start_date = '2000-01-01 00:00:00';
        $end_date = '2010-12-03 00:00:00';

        $min = strtotime($start_date);
        $max = strtotime($end_date);

        $val = rand($min, $max);

        return date('Y-m-d', $val);
    }
}

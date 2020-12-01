<?php

use Illuminate\Database\Seeder;

class UsertableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [

        	['email'=>'luatnguyen165@gmail.com','password'=>bcrypt(123456),'level'=>1],
        	['email'=>'nluat134@gmail.com','password'=>bcrypt(123456),'level'=>1],
        ];
        DB::table('vp_users')->insert($data);
    }
}

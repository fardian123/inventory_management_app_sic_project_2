<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // admin
            // [
            //     'name'=>'admin',
            //     'email'=>'admin@gmail.com',
            //     'password'=>Hash::make('adminadmin'),
            //     'sex'=>'wanita',
            //     'phone'=>'0811111111',
            //     'address'=>'j;;j;j;;j;j;j;jj;'
            // ],
            // [
            //     'name'=>'supervisor',
            //     'email'=>'supervisor@gmail.com',
            //     'password'=>Hash::make('supervisor'),
            //     'sex'=>'wanita',
            //     'phone'=>'0811111112',
            //     'address'=>'j;;j;j;;'
            // ],
            [
                'name'=>'jajang',
                'email'=>'jajang@gmail.com',
                'password'=>Hash::make('supervisor'),
                'sex'=>'wanita',
                'phone'=>'0811111113',
                'address'=>'j;;j;j;;'
            ]
        ]);
    }
}

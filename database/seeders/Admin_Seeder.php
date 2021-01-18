<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class Admin_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'01751151078',
            'password'=>Hash::make('admin'),
            'address'=>'Dinajpur',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('users')->delete();
        $user = \App\Models\User::updateOrCreate([
            'name'  => 'admin',
            'email' => 'admin@admin.com',
            'password'=>\Illuminate\Support\Facades\Hash::make('123456789')
        ]);
    }
}

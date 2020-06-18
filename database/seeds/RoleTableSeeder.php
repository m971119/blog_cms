<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            ['name' => 'administrator'],
            ['name' => 'subscriber'],
            ['name' => 'author']
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}

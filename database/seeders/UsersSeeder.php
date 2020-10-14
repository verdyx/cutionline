<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'asd',
            'password' => bcrypt('asdasd'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'ketua',
            'username' => 'ketua',
            'password' => bcrypt('asdasd'),
            'role' => 'pegawai',
        ]);

        User::create([
            'name' => 'kabag',
            'username' => 'kabag',
            'password' => bcrypt('asdasd'),
            'role' => 'pegawai',
        ]);

        User::create([
            'name' => 'kasubag',
            'username' => 'kasubag',
            'password' => bcrypt('asdasd'),
            'role' => 'pegawai',
        ]);

        User::create([
            'name' => 'pegawai',
            'username' => 'pegawai',
            'password' => bcrypt('asdasd'),
            'role' => 'pegawai',
        ]);

        Employee::create([
            'position' => 'Admin',
            'rank' => '3/a',
            'tmt_cpns' => '2025-10-29',
            'phone' => '089565656565',
            'boss_id' => null,
            'user_id' => 1,
        ]);

        Employee::create([
            'position' => 'Ketua',
            'rank' => '3/a',
            'tmt_cpns' => '2023-01-29',
            'phone' => '089565656565',
            'is_leader' => 1,
            'boss_id' => null,
            'user_id' => 2,
        ]);

        Employee::create([
            'position' => 'Kabag TI',
            'rank' => '3/a',
            'tmt_cpns' => '2023-01-29',
            'phone' => '089565656565',
            'boss_id' => 2,
            'user_id' => 3,
        ]);

        Employee::create([
            'position' => 'Kasubag TI',
            'rank' => '3/a',
            'tmt_cpns' => '2023-01-29',
            'phone' => '089565656565',
            'boss_id' => 3,
            'user_id' => 4,
        ]);

        Employee::create([
            'position' => 'Pegawai TI',
            'rank' => '3/a',
            'tmt_cpns' => '2023-01-29',
            'phone' => '089565656565',
            'boss_id' => 4,
            'user_id' => 5,
        ]);
    }
}

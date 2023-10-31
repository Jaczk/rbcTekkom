<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert(
            [
                'name' => 'SetoSeto',
                'nim' => '21120119130052',
                'email' => 'setogeming@test.com',
                'password' => Hash::make('seto123'),
                'role_id'=> 1,
                'phone' => '+62858036501',
                'is_loan' => 0,
                'fine' => 0,
                'created_at' =>now(),
                'updated_at' => now()
            ]
        );
    }
}

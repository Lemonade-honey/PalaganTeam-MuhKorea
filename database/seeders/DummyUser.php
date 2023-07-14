<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Dummy = [
            [
                'name' => 'nama user',
                'email' => 'user@gmail.com',
                'password' => '123456',
                'role' => 'user'
            ],
            [
                'name' => 'nama staf',
                'email' => 'staf@gmail.com',
                'password' => '123456',
                'role' => 'staf'
            ],
            [
                'name' => 'nama admin',
                'email' => 'admin@gmail.com',
                'password' => '123456',
                'role' => 'admin'
            ],
        ];

        foreach ($Dummy as $key => $value) {
            User::create($value);
        }
    }
    
    
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UsersDetails;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'password' => Hash::make('123456'),
                'email_verified_at' => date('Y-m-d H:i:s', strtotime(now())),
                'role' => 'user'
            ],
            [
                'name' => 'nama staf',
                'email' => 'staf@gmail.com',
                'password' => Hash::make('123456'),
                'email_verified_at' => date('Y-m-d H:i:s', strtotime(now())),
                'role' => 'staf'
            ],
            [
                'name' => 'nama admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
                'email_verified_at' => date('Y-m-d H:i:s', strtotime(now())),
                'role' => 'admin'
            ],
        ];

        foreach ($Dummy as $key => $value) {
            User::create($value);
            UsersDetails::create(['email' => $value['email']]);
        }
    }
    
    
}

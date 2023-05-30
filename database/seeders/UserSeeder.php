<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Member;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $users = [
            [
                'username' => 'Stevana1304',
                'password' => '123',
                'email' => 'steven@gmail.com',
                'role_id' => '1',
            ],
            [
                'username' => 'alif_adiawan',
                'password' => '123',
                'email' => 'alif@gmail.com',
                'role_id' => '1',
            ],
            [
                'username' => 'ilhmstxr',
                'password' => '123',
                'email' => 'ilhxm@gmail.com',
                'role_id' => '1',
            ],
            [
                'username' => 'client',
                'password' => '123', 
                'email' => 'client@gmail.com',
                'role_id' => '2',
            ],
            [
                'username' => 'clientacumalaka', 
                'password' => '123', 
                'email' => 'client2@gmail.com',
                'role_id' => '2',
            ],
            [
                'username' => 'owner', 
                'password' => '123', 
                'email' => 'owner@gmail.com',
                'role_id' => '3',
            ],
            [
                'username' => 'programmer',
                'password' => '123', 
                'email' => 'programmer@gmail.com',
                'role_id' => '4',
            ],
            [
                'username' => 'uiux', 
                'password' => '123', 
                'email' => 'uiux@gmail.com',
                'role_id' => '5',
            ],
            [
                'username' => 'sekretariat', 
                'password' => '123', 
                'email' => 'sekretariat@gmail.com',
                'role_id' => '6',
            ],
            [
                'username' => 'reborn',                
                'password' => '123', 
                'email' => 'reborn@gmail.com',
                'role_id' => '7',
            ],
        ];

        
        User::insert($users);
        
        $member = [
            ['id_member'=>"0004",'name'=>'si paling klien','nik'=>36780413213,'no_hp'=>"08572312",'alamat'=>"indo",'user_id'=>"4",],
            ['id_member'=>"007",'name'=>'si paling bukan klien','nik'=>36783213213,'no_hp'=>"0857232312",'alamat'=>"maag",'user_id'=>"5",]
        ];
        member::insert($member);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ShopUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ShopUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new ShopUser(array('first_name' => 'Lea', 'last_name' => 'Hodeib', 'phone_number_cc' => '+961', 'phone_number' => '71395729', 'email' => 'hdeiblea72@gmail.com', 'password' => Hash::make('password')));
        $user->save();

        $user->assignRole('super-admin');

    }
}

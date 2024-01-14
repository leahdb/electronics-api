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
        $dashboardUser = new ShopUser(array('first_name' => 'Lea', 'last_name' => 'Hodeib', 'phone_number_cc' => '+961', 'phone_number' => '71395729', 'email' => 'hdeiblea72@gmail.com', 'password' => Hash::make('password')));
        $dashboardUser->save();

        $dashboardUser->assignRole('super-admin');

        $shopUser = new ShopUser(array('first_name' => 'shop', 'last_name' => 'user', 'phone_number_cc' => '+961', 'phone_number' => '11111111', 'email' => 'shopuser@gmail.com', 'password' => Hash::make('12345678')));
        $shopUser->save();

        $shopUser->assignRole('shop-client');

    }
}

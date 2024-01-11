<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(DB::table('migrations')->where('migration', 'like', '%RoleSeeder%')->count() > 0){
            return;
        }

        Role::query()->create([
          'name' => 'super-admin',
          'guard_name' => 'shop'
        ]);

        Role::query()->create([
            'name' => 'shop-client',
            'guard_name' => 'shop'
        ]);
    }
}

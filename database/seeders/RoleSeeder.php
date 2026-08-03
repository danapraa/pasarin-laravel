<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        collect(['admin', 'seller', 'customer'])
            ->each(fn (string $role) => Role::firstOrCreate(['name' => $role]));

        $admin = User::firstOrCreate(
            ['email' => 'admin@pasarin.test'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        $admin->assignRole('admin');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user=User::create(['name' => 'admin',
            'email' => 'admin@bloodbank.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password')])
            ->assignRole('admin');
    }
}

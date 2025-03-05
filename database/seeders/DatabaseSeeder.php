<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'email' => "admin@ccms.net",
            'password' => Hash::make('kali'),
            'email_verified_at'=>now(),
            'is_admin' => true,
        ]);

        $this->command->info('Admin user created: ' . $user->email . " and password is 'kali'");
    }
}

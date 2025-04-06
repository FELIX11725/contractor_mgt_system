<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\branch;
use App\Models\business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            // 'business_id' => $business->id,
            // 'branch_id' => $branch->id,
        ]);

        $business = business::create([
            'business_name' => 'Contractor Management System',
            'business_address' => '123 Main St, Anytown, USA',
            'business_phone' => '123-456-7890',
            'business_email' => 'admin@ccms.net',
            'business_location' => 'Florida, USA',
            'business_status' => 'active',
            'created_by' => $user->id,
        ]);

        //create branch
        $branch = branch::create([
            'business_id' => $business->id,
            'branch_name' => 'Headquarters',
            'branch_code' => 'HQ',
            'branch_address' => '123 Main St, Anytown, USA',
            'branch_phone' => '123-456-7890',
            'branch_email' => 'admin@ccms.net',
            'is_main' => 1,
        ]);

        $user->business_id = $business->id;
        $user->branch_id = $branch->id;
        $user->save();


        

        $this->command->info('Admin user created: ' . $user->email . " and password is 'kali'");

        $this->call([
            PermissionSeeder::class,
        ]);
    }

  
}

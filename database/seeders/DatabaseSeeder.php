<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Database\Factories\TicketFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (! User::where('email', 'admin@minicrm.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@minicrm.com',
                'password' => bcrypt('password'),
            ]);
        }

        Customer::factory(10)->create();
        TicketFactory::times(10)->create();
    }
}

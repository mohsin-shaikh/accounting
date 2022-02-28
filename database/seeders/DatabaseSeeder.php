<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Mohsin Shaikh',
            'email' => 'admin@gmail.com',
        ]);
        $this->call(BookSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(EntrySeeder::class);
    }
}

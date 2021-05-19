<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wallet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::factory(10)->create();

        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'amount' => 100000
            ]);
        }
    }
}

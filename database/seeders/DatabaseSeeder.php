<?php

namespace Database\Seeders;

use Domain\Wallet\Models\Wallet;
use Domain\User\Models\User;

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
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'amount' => 100000
            ]);
        }
    }
}

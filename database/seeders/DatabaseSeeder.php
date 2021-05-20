<?php

namespace Database\Seeders;

use Domain\Wallet\Models\Wallet;

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
        $users = \Domain\User\Models\User::factory(10)->create();

        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'amount' => 1000000
            ]);
        }
    }
}

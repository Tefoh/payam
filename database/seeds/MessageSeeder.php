<?php

use App\Qasedak\Message\Message;
use App\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 11; $i++) {
            $user = factory(User::class)->create();
            factory(Message::class, 10)->create(['author' => $user->id]);
        }
    }
}

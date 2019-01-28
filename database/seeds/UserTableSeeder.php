<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'first_name' => 'Jonas',
            'last_name' => 'Hildrestrand',
            'username' => 'hiljon',
            'password' => (new BcryptHasher())->make('12345678')
        ]);

        $user->save();
    }
}

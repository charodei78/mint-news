<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $user = User::factory()->make();
	    $user->email = "admin@mint-news.ru";
	    $user->password = Hash::make('admin');
	    $user->save();
    }
}

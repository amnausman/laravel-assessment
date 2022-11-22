<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('photos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $users = [
            ['id' => 1, 'role_id' => 1, 'name' => 'Majid Shahzeb', 'phone' => '03359369361', 'email' => 'itssmaaann@gmail.com', 'email_verified_at' => now(),'password' => Hash::make('Majid_123'), 'remember_token' => Str::random(10)],
            ['id' => 2, 'role_id' => 2, 'name' => 'Umair', 'phone' => '03359369363',  'email' => 'umair@gmail.com', 'email_verified_at' => now(),'password' => Hash::make('Majid_123'), 'remember_token' => Str::random(10)],
        ];

        DB::table('users')->insert($users);

        foreach($users as $user){
            Photo::create([
                'filename' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
                'imageable_id' => $user['id'],
                'imageable_type' => 'App\Models\User'
            ]);
        }

        User::factory()->count(5)->create(); //You can increase value in count to populate users table with as many records as you want

        $newUsers = User::whereNotIn('id', [1,2])->get();
        foreach($newUsers as $user){
            Photo::create([
                'filename' => 'https://placeimg.com/100/100/any?' . rand(1, 100),
                'imageable_id' => $user->id,
                'imageable_type' => 'App\Models\User'
            ]);
        }
    }
}

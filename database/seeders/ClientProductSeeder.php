<?php

namespace Database\Seeders;

use App\Models\ClientProduct;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

       foreach ($users as $key => $user) {
        ClientProduct::factory()->create([
            'user_id' => $user->id,
        ]);
       } 
        
    }
}

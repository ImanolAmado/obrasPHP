<?php

namespace Database\Seeders;
use App\Models\Obra;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ObraUser;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //User::factory(15)->create();
        Obra::factory(15)->create();        
        //ObraUser::factory(20)->create();
        
        // \App\Models\User::factory(10)->create();

        /*
        User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password')
        ]);

        */

    }
}

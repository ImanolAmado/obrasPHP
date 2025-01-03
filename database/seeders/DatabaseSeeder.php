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
    
    Obra::factory(60)->create(); 

    // Crea 6 registros iniciales de votaciones en obra_users
    $this->call(ObraUserSeeder::class);

    
             /*
        User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => bcrypt('password')
        ]);
        */

    }
}

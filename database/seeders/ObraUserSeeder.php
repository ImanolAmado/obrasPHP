<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ObraUser;

class ObraUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $obraUser = new ObraUser();
        $obraUser->obra_id = 1;
        $obraUser->user_id = 1;
        $obraUser->voto = rand(1,5);      
        $obraUser->save();  

        $obraUser = new ObraUser();
        $obraUser->obra_id = 2;
        $obraUser->user_id = 2;
        $obraUser->voto = rand(1,5);      
        $obraUser->save(); 

        $obraUser = new ObraUser();
        $obraUser->obra_id = 3;
        $obraUser->user_id = 3;
        $obraUser->voto = rand(1,5);      
        $obraUser->save();  

        $obraUser = new ObraUser();
        $obraUser->obra_id = 4;
        $obraUser->user_id = 4;
        $obraUser->voto = rand(1,5);      
        $obraUser->save();  

        $obraUser = new ObraUser();
        $obraUser->obra_id = 5;
        $obraUser->user_id = 5;
        $obraUser->voto = rand(1,5);      
        $obraUser->save();  

        $obraUser = new ObraUser();
        $obraUser->obra_id = 1;
        $obraUser->user_id = 1;
        $obraUser->voto = rand(1,5);      
        $obraUser->save();  

    }
}

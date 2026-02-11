<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChileComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/chile.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->error("Archivo no encontrado: $jsonPath");
            return;
        }

        $json = File::get($jsonPath);
        $data = json_decode($json, true);


            
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('comunas')->truncate();
        DB::table('regiones')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        DB::transaction(function () use ($data) {
            foreach ($data as $regionData) {
                $regionId = DB::table('regiones')->insertGetId([
                    'nombre' => $regionData['region'],
                    'iso' => $regionData['region_iso_3166_2']
                ]);

                foreach ($regionData['provincias'] as $provincia) {
                    
                    foreach ($provincia['comunas'] as $comuna) {
                        DB::table('comunas')->insert([
                            'nombre'    => $comuna['nombre'],
                            'region_id' => $regionId,
                        ]);
                    }
                }
            }
        });
    }
}
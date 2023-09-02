<?php

namespace Database\Seeders;

use App\Models\TacheModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TachesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {
            TacheModel::create([
                'Nom' => 'Demenagement',
                'Description' => $faker->sentence(10),
                'Date_echeance' => $faker->dateTimeBetween('+1 days', '+1 years')->format('Y-m-d'),
                'Date_creation' => '2023-06-08',
                'idUser' => 4,
                'idPriorite' => $faker->randomElement([1, 2, 3, 4]),
                'idStatut' => $faker->randomElement([1, 2]),
            ]);            
        }
    }
}

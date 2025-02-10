<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProdutoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create(); 

        $userIds = [1];

        foreach ($userIds as $user_id) {
            foreach (range(1, 5) as $index) {
                Produto::create([
                    'user_id' => $user_id, 
                    'descricao' => $faker->word, 
                    'comprimento' => $faker->numberBetween(50, 300), 
                    'largura' => $faker->numberBetween(30, 150), 
                    'tipo_medida' => $faker->randomElement(['unidade', 'peso']), 
                ]);
            }
        }
    }
}

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

        foreach (range(1, 20) as $index) {
            Produto::create([
                'descricao' => $faker->word, 
                'comprimento' => $faker->numberBetween(50, 300), 
                'largura' => $faker->numberBetween(30, 150), 
                'tipo_medida' => $faker->randomElement(['unidade', 'peso']), 
            ]);
        }
    }
}

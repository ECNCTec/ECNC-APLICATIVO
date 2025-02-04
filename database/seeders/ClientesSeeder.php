<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('clientes')->insert([
                'cpf_cnpj' => fake()->unique()->numerify('###########'),
                'tipo_pessoa' => fake()->randomElement(['fisica', 'juridica']),
                'sexo' => fake()->randomElement(['masculino', 'feminino']),
                'inscricao_rg' => fake()->numerify('#########'),
                'razao_social' => fake()->company(),
                'nome_fantasia' => fake()->company(),
                'cep' => fake()->postcode(),
                'endereco' => fake()->streetAddress(),
                'complemento' => fake()->secondaryAddress(),
                'bairro' => fake()->citySuffix(),
                'estado' => fake()->stateAbbr(),
                'cidade' => fake()->city(),
                'email' => fake()->unique()->safeEmail(),
                'telefone' => fake()->phoneNumber(),
                'inscricao_municipal' => fake()->numerify('#########'),
                'regime_tributario' => 'Simples Nacional',
                'contribuinte_icms' => 'Não',
                'operacao_consumidor_final' => 'Sim',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

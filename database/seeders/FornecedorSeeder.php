<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use App\Models\User;  
use Faker\Factory as Faker;

class FornecedorSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $userIds = [1];

        foreach ($userIds as $userId) {
            for ($i = 0; $i < 5; $i++) {
                Fornecedor::create([
                    'user_id' => $userId, 
                    'cpf_cnpj' => $faker->numerify('###.###.###-##'), 
                    'tipo_pessoa' => $faker->randomElement(['fisica', 'juridica']),
                    'sexo' => $faker->randomElement(['masculino', 'feminino']),
                    'inscricao_rg' => $faker->word,
                    'razao_social' => $faker->company,
                    'nome_fantasia' => $faker->companySuffix,
                    'cep' => $faker->postcode,
                    'endereco' => $faker->streetAddress,
                    'complemento' => $faker->secondaryAddress,
                    'bairro' => $faker->citySuffix,
                    'estado' => $faker->stateAbbr,
                    'cidade' => $faker->city,
                    'email' => $faker->email,
                    'telefone' => $faker->phoneNumber,
                    'status' => $faker->randomElement(['ativo', 'inativo']),
                    'inscricao_municipal' => $faker->word,
                    'regime_tributario' => $faker->randomElement(['Simples Nacional', 'Lucro Presumido', 'Lucro Real']),
                    'contribuinte_icms' => $faker->randomElement(['Sim', 'Não']),
                    'operacao_consumidor_final' => $faker->randomElement(['Sim', 'Não']),
                ]);
            }
        }
    }
}

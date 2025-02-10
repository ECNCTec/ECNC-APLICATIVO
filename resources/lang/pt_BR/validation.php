<?php

return [
    'required' => 'O campo :attribute é obrigatório.',
    'unique' => 'O campo :attribute já foi registrado.',
    'regex' => 'O formato do campo :attribute é inválido.',

    'custom' => [
        'cpf_cnpj' => [
            'unique' => 'Este CPF ou CNPJ já foi registrado.',
            'regex' => 'O CPF ou CNPJ deve conter apenas números.',
        ],
        'cep' => [
            'regex' => 'O campo CEP deve conter apenas números, com 8 dígitos.',
        ],
        'telefone' => [
            'regex' => 'O campo telefone deve conter apenas números.',
        ],
        'tipoMedidaProduto' => [
            'required' => 'Por favor, selecione uma opção para o Tipo de Medida.',
        ],
    ],

    'attributes' => [
        'cpf_cnpj' => 'CPF/CNPJ',
        'tipo_pessoa' => 'tipo de pessoa',
        'cep' => 'CEP',
        'telefone' => 'telefone',
    ],
];

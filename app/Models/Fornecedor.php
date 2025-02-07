<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'cpf_cnpj',
        'tipo_pessoa',
        'sexo',
        'inscricao_rg',
        'razao_social',
        'nome_fantasia',
        'cep',
        'endereco',
        'complemento',
        'bairro',
        'estado',
        'cidade',
        'email',
        'telefone',
        'status',
        'inscricao_municipal',
        'regime_tributario',
        'contribuinte_icms',
        'operacao_consumidor_final',
    ];
}

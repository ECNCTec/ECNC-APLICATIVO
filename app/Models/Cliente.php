<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
        'inscricao_municipal',
        'regime_tributario',
        'contribuinte_icms',
        'operacao_consumidor_final',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

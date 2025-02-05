<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'descricao',
        'comprimento',
        'largura',
        'tipo_medida',
    ];

    protected $casts = [
        'comprimento' => 'integer',
        'largura' => 'integer',
    ];
}

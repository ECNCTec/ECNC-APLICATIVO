<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'produto_id',
        'fornecedor_id',
        'quantidade_pecas',
        'custo',
        'operacao',
    ];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeAplicarFiltros($query, $filtros)
    {
        return $query
            ->when($filtros['search'] ?? null, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->whereHas('produto', function ($q) use ($search) {
                        $q->where('descricao', 'like', '%' . $search . '%');
                    })->orWhere('id', '=', $search);
                });
            })
            ->when($filtros['quantidadeMaximaPecas'] ?? null, function ($query, $quantidadeMaximaPecas) {
                return $query->where('quantidade_pecas', '<=', $quantidadeMaximaPecas);
            })
            ->when($filtros['quantidadeMinimaPecas'] ?? null, function ($query, $quantidadeMinimaPecas) {
                return $query->where('quantidade_pecas', '>=', $quantidadeMinimaPecas);
            })
            ->when($filtros['dataInicial'] ?? null, function ($query, $dataInicial) {
                return $query->where('created_at', '>=', $dataInicial);
            })
            ->when($filtros['dataFinal'] ?? null, function ($query, $dataFinal) {
                return $query->where('created_at', '<=', $dataFinal);
            })
            ->when($filtros['operacao'] ?? null, function ($query, $operacao) {
                return $query->where('operacao', '=', $operacao);
            });
    }
}

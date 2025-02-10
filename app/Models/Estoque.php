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
        'custo'
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
}

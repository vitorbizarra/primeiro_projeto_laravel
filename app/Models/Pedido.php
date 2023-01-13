<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function produtos()
    {
        // return $this->belongsToMany(\App\Models\PedidoProduto::class, 'pedidos_produtos');

        return $this->belongsToMany(\App\Models\Item::class, 'pedidos_produtos', 'pedido_id', 'produto_id')->withPivot('id', 'created_at', 'updated_at');

        /**
         * Parâmetros:
         * 1 - Modelo do relacionamento NXN em relação ao Modelo que estamos implementando
         * 2 - É a tabela auxiliar que armazena os registros do relacionamento
         * 3 - Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
         * 4 - Representa o nome da FK mapeada pelo model utilizado no relacionamento que estamos implementando
         */
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
    use HasFactory;

    protected $table = 'moradores';

    protected $fillable = ['nome', 'data_nascimento', 'rg', 'cpf', 'telefone', 'celular', 'email', 'unidade_id'];

    // Relacionamentos
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
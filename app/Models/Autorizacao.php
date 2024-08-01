<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorizacao extends Model
{
    use HasFactory;

    protected $table = 'autorizacoes';

    protected $fillable = ['nivel_acesso','visitante', 'data_inicio', 'data_fim', 'morador_id'];

    // Relacionamentos
    public function morador()
    {
        return $this->belongsTo(Morador::class);
    }
}
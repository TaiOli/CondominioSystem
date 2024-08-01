<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use HasFactory;

    protected $table = 'veiculos';

    protected $fillable = ['marca', 'modelo', 'ano', 'cor', 'placa', 'chassi','unidade_id'];

    // Relacionamentos
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
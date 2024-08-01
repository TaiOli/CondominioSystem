<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';

    protected $fillable = ['tipo_documento', 'descricao', 'data_emissao', 'morador_id'];

    // Relacionamentos
    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $table = 'animais';

    protected $fillable = ['tipo', 'raca', 'idade', 'nome', 'unidade_id'];

    // Relacionamentos
    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }
}
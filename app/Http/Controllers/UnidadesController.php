<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Unidade;


class UnidadesController extends Controller
{
    // Buscando todas as unidades do banco de dados
    public function index()
    {
        $unidades = Unidade::all(['id', 'edificio', 'apartamento']);
        return response()->json($unidades);
    }
}
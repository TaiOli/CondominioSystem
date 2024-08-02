<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Animal;


class AnimaisController extends Controller
{
    protected $animal;

    // Construtor
    public function __construct()
    {
        $this->animal = new Animal();
    }

    // Buscando do banco de dados
    public function index(Request $request)
    {
        $unidadeId = $request->query('unidade_id');
        $animal = Animal::where('unidade_id', $unidadeId)->get();
        return response()->json($animal);
    }

    // Inserindo no banco de dados
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo' => 'nullable|string|max:50',
            'raca' => 'nullable|string|max:50',
            'idade' => 'nullable|integer',
            'nome' => 'nullable|string|max:50',
            'unidade_id' => 'required|exists:unidades,id',
        ]);

        try {
            $animal = Animal::create($validatedData);
            return response()->json(['message' => 'Animal cadastrado com sucesso!', 'animal' => $animal], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao cadastrar o animal.'], 500);
        }
    }
}
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

    // Retorna os dados do banco
    public function show($id)
    {
        $animal = Animal::find($id);

        if (!$animal) {
            return response()->json(['message' => 'Animal não encontrado'], 404);
        }

        return response()->json($animal);
    }

     // Atualizacao dos dados
     public function update(Request $request, $id)
     {
         $animal = Animal::find($id);
     
         if (!$animal) {
             return response()->json(['message' => 'Animal não encontrado'], 404);
         }
     
         // Atualizando a validação
         $validatedData = $request->validate([
            'tipo' => 'required|string|max:50',
            'raca' => 'required|string|max:50',
            'idade' => 'required|integer|min:0', 
            'nome' => 'required|string|max:50',
            'unidade_id' => 'required|exists:unidades,id', 
         ]);
     
         $animal->update($validatedData);
     
         return response()->json($animal);
     }
}
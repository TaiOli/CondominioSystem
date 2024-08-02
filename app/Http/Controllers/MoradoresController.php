<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Morador;

class MoradoresController extends Controller
{
    protected $morador;

    // Construtor
    public function __construct()
    {
        $this->morador = new Morador();
    }

    // Buscando do banco de dados
    public function index(Request $request)
    {
        $unidadeId = $request->query('unidade_id');
        
        if ($unidadeId) {
            $moradores = Morador::where('unidade_id', $unidadeId)->get();
        } else {
            $moradores = Morador::all(['id', 'nome']);
        }

        return response()->json($moradores);
    }

    // Inserindo no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'nome' => 'required|string|max:100',
            'dataNascimento' => 'nullable|date',
            'rg' => 'nullable|string|max:20',
            'cpf' => 'required|string|size:11|unique:moradores,cpf',
            'telefone' => 'nullable|string|max:15',
            'celular' => 'required|string|max:15',
            'email' => 'nullable|email|max:100',
            'unidade_id' => 'required|exists:unidades,id', 
        ]);

        // Validação data de nascimento
        $validatedData['data_nascimento'] = $validatedData['dataNascimento'];
        unset($validatedData['dataNascimento']);

        \Log::info('Validated Data:', $validatedData);

        Morador::create($validatedData);

        return response()->json(['message' => 'Morador cadastrado com sucesso!'], 201);
    }

    // Retorna os dados do banco
    public function show($id)
    {
        $morador = Morador::find($id);

        if (!$morador) {
            return response()->json(['message' => 'Morador não encontrado'], 404);
        }

        return response()->json($morador);
    }

     // Atualizacao dos dados
     public function update(Request $request, $id)
     {
         $morador = Morador::find($id);
     
         if (!$morador) {
             return response()->json(['message' => 'Morador não encontrado'], 404);
         }
     
         // Atualizando a validação
         $validatedData = $request->validate([
              'nome' => 'required|string|max:100',
              'data_nascimento' => 'nullable|date',
              'rg' => 'nullable|string|max:20',
              'cpf' => 'required|string|size:11|unique:moradores,cpf,' . $id,
              'telefone' => 'nullable|string|max:15',
              'celular' => 'nullable|string|max:15',
              'email' => 'nullable|email|max:100',
              'unidade_id' => 'required|exists:unidades,id',
         ]);
     
         $morador->update($validatedData);
     
         return response()->json($morador);
     }
}
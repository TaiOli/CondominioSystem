<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Veiculo;


class VeiculosController extends Controller
{
    protected $veiculo;

    // Construtor
    public function __construct()
    {
        $this->veiculo = new Veiculo();
    }

    // Buscando do banco de dados
    public function index(Request $request)
    {
        $unidadeId = $request->query('unidade_id');
        $veiculos = Veiculo::where('unidade_id', $unidadeId)->get();
        
        return response()->json($veiculos);
    }

    // Inserindo no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'marca' => 'string|max:50',
            'modelo' => 'string|max:50',
            'ano' => 'integer|min:1886|max:' . (date('Y') + 1),
            'cor' => 'string|max:20',
            'placa' => 'string|max:10|unique:veiculos,placa',
            'chassi' => 'string|max:30|unique:veiculos,chassi',
            'unidade_id' => 'exists:unidades,id',
        ]);

        \Log::info('Validated Data:', $validatedData);

        // Criação do veículo
        Veiculo::create($validatedData);

        return response()->json(['message' => 'Veículo cadastrado com sucesso!'], 201);
    }
}
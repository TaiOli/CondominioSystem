<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Morador;
use App\Models\Autorizacao;


class AutorizacoesController extends Controller
{
    protected $autorizacao;

    // Construtor
    public function __construct()
    {
        $this->autorizacao = new Autorizacao();
    }

    // Buscando do banco de dados
    public function index(Request $request)
    {
        $unidadeId = $request->query('unidade_id');
    
        if ($unidadeId) {
            $autorizacoes = Autorizacao::whereHas('morador', function($query) use ($unidadeId) {
                $query->where('unidade_id', $unidadeId);
            })->with('morador')->get();
        } else {
            $autorizacoes = [];
        }
    
        return response()->json($autorizacoes);
    }

    // Inserindo no banco de dados
    public function store(Request $request)
    {
        \Log::info('Dados da solicitação:', $request->all());
        // Validação dos dados
        $validatedData = $request->validate([
            'nivel_acesso' => 'required|string|max:50',
            'visitante' => 'required|string|max:50',
            'data_inicio' => 'required|date',
            'data_fim' => 'required|date|after_or_equal:data_inicio',
            'morador_id' => 'required|exists:moradores,id',
        ]);

        try {
            $autorizacao = Autorizacao::create($validatedData);
            return response()->json(['message' => 'Autorização cadastrada com sucesso!', 'autorizacao' => $autorizacao], 201);
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao cadastrar a autorização.', 'error' => $e->getMessage()], 500);
        }
    }
}
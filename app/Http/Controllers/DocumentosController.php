<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Documento;


class DocumentosController extends Controller
{
    protected $documento;

    // Construtor
    public function __construct()
    {
        $this->documento = new Documento();
    }

    // Buscando do banco de dados
    public function index(Request $request)
    {
        $moradorId = $request->query('morador_id');

        if ($moradorId) {
            $documentos = Documento::where('morador_id', $moradorId)->get();
        } else {
            $documentos = [];
        }

        return response()->json($documentos);
    }

    // Inserindo no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'descricao' => 'nullable|string',
            'data_emissao' => 'nullable|date',
            'morador_id' => 'required|exists:moradores,id',
        ]);

        try {
            $documento = Documento::create($validatedData);
            return response()->json(['message' => 'Documento cadastrado com sucesso!', 'documento' => $documento], 201);
        
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao cadastrar o documento.', 'error' => $e->getMessage()], 500);
        }
    }

    // Retorna os dados do banco
    public function show($id)
    {
        $documento = Documento::find($id);

        if (!$documento) {
            return response()->json(['message' => 'Autorização não encontrada'], 404);
        }

        return response()->json($documento);
    }

    // Atualizacao dos dados
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);
    
        if (!$documento) {
            return response()->json(['message' => 'Documentos não encontrados'], 404);
        }
    
        // Atualizando a validação
        $validatedData = $request->validate([
            'tipo_documento' => 'required|string|max:50',
            'descricao' => 'nullable|string',
            'data_emissao' => 'nullable|date',
            'morador_id' => 'required|exists:moradores,id',  
        ]);
    
        $documento->update($validatedData);
    
        return response()->json($documento);
    }
}
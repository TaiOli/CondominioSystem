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
}
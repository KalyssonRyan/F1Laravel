<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Illuminate\Http\Request;

class PilotoController extends Controller
{
    public function index(Request $request)
    {
        // Filtros que o usuário pode passar na URL (por exemplo, filtro por nome ou nacionalidade)
        $filters = $request->only(['name', 'nationality']);
        
        // Filtro aplicado ao modelo Piloto
        $pilotos = Piloto::filter($filters)->paginate(10)->withQueryString();
        
         return view('pilotos.index', compact('pilotos'));
    }
    public function listar()
    {
        // Obtém todos os pilotos do banco de dados
         $pilotos = Piloto::paginate(10);  // Pega todos os pilotos
        // Retorna a view 'pilotos.list' e passa os pilotos para a view
        
        return view('pilotos.list',compact('pilotos'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Busca de pilotos com o Laravel Scout
        $pilotos = Piloto::search($query)->get();
        
        return view('pilotos.search-results', compact('pilotos'));
    }

    public function home()
    {
        // Exibir todos os pilotos na página inicial (ou uma visão padrão)
        $pilotos = Piloto::all();
        return view('pilotos.index', compact('pilotos'));
    }

    public function create()
    {
        // Formulário para criar um novo piloto
        return view('pilotos.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados do piloto
        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'foto' => 'nullable|file|image|mimes:jpeg,png,gif|max:2048', // Foto do piloto (opcional)
        ]);
    
        // Criação do piloto no banco de dados
        $piloto = Piloto::create([
            'nome' => $request->nome,
            'nacionalidade' => $request->nacionalidade,
            'data_nascimento' => $request->data_nascimento,
        ]);
    
        // Caso o piloto tenha uma foto, armazena ela
        if ($request->hasFile('foto')) {
            $piloto->storeFoto($request->file('foto'));
        }
    
        return redirect()->route('home')->with('success', 'Piloto criado com sucesso.');
    }

    public function show(Piloto $piloto)
    {
        // Exibir detalhes de um piloto específico
        return view('pilotos.show', compact('piloto'));
    }

    public function edit(Piloto $piloto)
    {
        // Formulário para editar um piloto
        return view('pilotos.edit', compact('piloto'));
    }

    public function update(Request $request, Piloto $piloto)
    {
        // Validação dos dados do piloto
        $request->validate([
            'nome' => 'required|string|max:255',
            'nacionalidade' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'foto' => 'nullable|file|image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        // Atualizar os dados do piloto
        $piloto->nome = $request->nome;
        $piloto->nacionalidade = $request->nacionalidade;
        $piloto->data_nascimento = $request->data_nascimento;
    
        // Se houver uma nova foto, armazená-la
        if ($request->hasFile('foto')) {
            $piloto->storeFoto($request->file('foto'));
        }
    
        $piloto->save();
    
        return redirect()->route('home')->with('success', 'Piloto atualizado com sucesso.');
    }

    public function destroy(Piloto $piloto)
    {
        // Deletar o piloto
        $piloto->delete();

        return redirect()->route('home')
                         ->with('success', 'Piloto deletado com sucesso.');
    }
}

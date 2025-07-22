<?php
namespace App\Http\Controllers;

use App\Models\Equipe;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index(Request $request)
    {
        //$equipe = Equipe::all();
        $filters = $request->only(['title', 'description']);
        $equipes = Equipe::filter($filters)->paginate(10)->withQueryString();
        return view('equipes.index', compact('equipes'));
    }
    public function listar()
    {
        // Obtém todos os pilotos do banco de dados
         $equipes = Equipe::paginate(10);  // Pega todos os pilotos
        // Retorna a view 'pilotos.list' e passa os pilotos para a view
        
        return view('equipes.list',compact('equipes'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $equipes = Equipe::search($query)->get();

        return view('equipes.search-results', compact('equipes'));
    }

    public function home()
    {
        $equipe = Equipe::all();
        return view('home', compact('equipe'));
    }

    public function create()
    {
        return view('equipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'foto' => 'required|file|image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        $Equipe = Equipe::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);
    
        $Equipe->storeArquivo($request->file('foto'));
    
        return redirect()->route('equipes.listar')->with('success', 'Notícia criada com sucesso.');
    }

    public function show(Equipe $Equipe)
    {
        return view('equipes.show', compact('Equipe'));
    }

    public function edit(Equipe $Equipe)
    {
        return view('equipes.edit', compact('Equipe'));
    }

    public function update(Request $request, Equipe $Equipe)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'arquivo' => 'nullable|file|image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        $Equipe->nome = $request-> nome;
        $Equipe->descricao = $request->descricao;
    
        if ($request->hasFile('arquivo')) {
            // Se um novo arquivo for enviado, armazenar e atualizar a URL
            $Equipe->storeArquivo($request->file('arquivo'));
        }
    
        $Equipe->save();
    
        return redirect()->route('equipes.listar')->with('success', 'Notícia atualizada com sucesso.');
    
    }

    public function destroy(Equipe $Equipe)
    {
        $Equipe->delete();

        return redirect()->route('equipes.listar')
                         ->with('success', 'Notícia deletada com sucesso.');
    }

    
}
?>
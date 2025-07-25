<?php
namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        //$noticias = Noticia::all();
        $filters = $request->only(['title', 'description']);
        $noticias = Noticia::filter($filters)->paginate(10)->withQueryString();
        return view('noticias.index', compact('noticias'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $noticias = Noticia::search($query)->get();

        return view('search-results', compact('noticias'));
    }

    public function home()
    {
        $noticias = Noticia::all();
        return view('home', compact('noticias'));
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'arquivo' => 'required|file|image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        $noticia = Noticia::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
        ]);
    
        $noticia->storeArquivo($request->file('arquivo'));
    
        return redirect()->route('dashboard')->with('success', 'Notícia criada com sucesso.');
    }

    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'arquivo' => 'nullable|file|image|mimes:jpeg,png,gif|max:2048',
        ]);
    
        $noticia->titulo = $request->titulo;
        $noticia->descricao = $request->descricao;
    
        if ($request->hasFile('arquivo')) {
            // Se um novo arquivo for enviado, armazenar e atualizar a URL
            $noticia->storeArquivo($request->file('arquivo'));
        }
    
        $noticia->save();
    
        return redirect()->route('dashboard')->with('success', 'Notícia atualizada com sucesso.');
    
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();

        return redirect()->route('dashboard')
                         ->with('success', 'Notícia deletada com sucesso.');
    }

    
}
?>
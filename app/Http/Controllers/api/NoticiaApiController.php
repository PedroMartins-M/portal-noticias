<?php
 
namespace App\Http\Controllers\Api;
 
use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
 
class NoticiaApiController extends Controller
{
    public function index() //GET
    {
        $noticias = Noticia::all();
 
        return response()->json($noticias);
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //POST
    {
        $request->validate([
            'titulo' => 'required|min:10',
            'resumo' => 'required|min:20',
            'conteudo' => 'required|min:20',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        $noticia = new Noticia();
 
        $noticia->titulo = $request->titulo;
        $noticia->resumo = $request->resumo;
        $noticia->conteudo = $request->conteudo;
        $noticia->categoria_id = $request->categoria_id;
        $noticia->status = $request->status;
        $noticia->usuario_id = Auth::user()->id;
 
        if ($request->hasFile('imagem')) {
 
            $noticia->imagem = $request->file('imagem')->store('noticias', 'public');
        }
 
        $noticia->save();
 
        return response()->json([
            'message' => 'Notícia cadastrada com sucesso!',
            'data' => $noticia
        ]);
    }
 
    /**
     * Display the specified resource.
     */
    public function show(string $id) //GET
    {
        $noticia = Noticia::findOrFail($id);
        return response()->json($noticia);
    }
 
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) //PUT
    {
        $request->validate([
            'titulo' => 'required|min:10',
            'resumo' => 'required|min:20',
            'conteudo' => 'required|min:20',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        $noticia = Noticia::findOrFail($id);
 
        $noticia->titulo = $request->titulo;
        $noticia->resumo = $request->resumo;
        $noticia->conteudo = $request->conteudo;
        $noticia->categoria_id = $request->categoria_id;
        $noticia->status = $request->status;
        $noticia->usuario_id = Auth::user()->id;
 
        if ($request->hasFile('imagem')) {
 
            if ($noticia->imagem) {
                Storage::disk('public')->delete($noticia->imagem);
            }
 
            $noticia->imagem = $request->file('imagem')->store('noticias', 'public');
        }
 
        $noticia->save();
 
        return response()->json([
            'message' => 'Notícia atualizada com sucesso!',
            'data' => $noticia
        ]);
    }
 
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) //DELETE
    {
        $noticia =Noticia::findOrFail($id);
        $noticia->delete();
 
        return response()->json([
            'message' => 'Notícia removida com sucesso!'
        ]);
    }
}
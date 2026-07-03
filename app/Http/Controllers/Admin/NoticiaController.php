<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $noticias = Noticia::all();
        return view('admin.noticias.index',[
            "noticias" => $noticias
        ]);
            
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::orderby('nome', 'asc')->pluck('nome', 'id');

        //dd($categorias);

        return view('admin.noticias.cadastrar', [
            'categorias' => $categorias,
            'noticia' => new Noticia()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:10',
            'resumo' => 'required',
            'conteudo' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $noticia = new Noticia();

        $noticia->titulo = $request->titulo;
        $noticia->resumo = $request->resumo;
        $noticia->conteudo = $request->conteudo;
        $noticia->categoria_id = $request->categoria_id;
        $noticia->status = $request->status;
        $noticia->usuario_id = Auth::user()->id;
        
        if($request->hasFile('imagem')){

            $noticia->imagem = $request->file('imagem')->store('noticias', 'public');
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categorias = Categoria::orderby('nome', 'ASC')->pluck('nome', 'id');
        
        return view('admin.noticias.cadastrar', [
            'categorias' => $categorias,
            'noticia' => Noticia::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'titulo' => 'required|min:10',
            'resumo' => 'required',
            'conteudo' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $noticia = Noticia::findOrFail($id);

        $noticia->titulo = $request->titulo;
        $noticia->resumo = $request->resumo;
        $noticia->conteudo = $request->conteudo;
        $noticia->categoria_id = $request->categoria_id;
        $noticia->status = $request->status;
        $noticia->usuario_id = Auth::user()->id;
        
        if($request->hasFile('imagem')){

        if($noticia->imagem){
                Storage::disk('public')->delete($noticia->imagem);
            }

            $noticia->imagem = $request->file('imagem')->store('noticias', 'public');
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $noticias = Noticia::findorfail($id);
        $noticias->delete();
        return redirect()->route('admin.noticias.index');
    }
}

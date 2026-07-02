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
            "categorias" => $categorias
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

        $noticias = new Noticia();

        $noticias->titulo = $request->titulo;
        $noticias->resumo = $request->resumo;
        $noticias->conteudo = $request->conteudo;
        $noticias->categoria_id = $request->categoria_id;
        $noticias->status = $request->status;
        $noticias->usuario_id = Auth::user()->id;
        
        if($request->hasFile('imagem')){

            $noticias->imagem = $request->file('imagem')->store('noticias', 'public');
        }

        $noticias->save();

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Noticia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index',[
            "categoria" => $categorias
        ]);
            
    }

    public function create()
    {
        $categorias = Categoria::orderby('nome', 'asc')->pluck('nome', 'id');

        //dd($categorias);

        return view('admin.categorias.cadastrar', [

            'noticia' => new Noticia()
        ]);
    }

     public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'cor' => 'required',
        ]);

        $categoria = new Categoria();

        $categoria->nome = $request->nome;
        $categoria->descricao = $request->descricao;
        $categoria->cor = $request->cor;
        $categoria->usuario_id = Auth::user()->id;
        

        $categoria->save();

        return redirect()->route('admin.categorias.index');

    }

     public function edit(string $id)
    {
        $categorias = Categoria::orderby('nome', 'ASC')->pluck('nome', 'id');
        
        return view('admin.noticias.cadastrar', [
            'categorias' => $categorias,
            'noticia' => Noticia::findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
         $request->validate([
            'nome' => 'required|min:10',
            'descricao' => 'required',
            'cor' => 'required',
            'categoria_id' => 'required',
        ]);

        $categoria = Noticia::findOrFail($id);

        $categoria->nome = $request->titulo;
        $categoria->descricao = $request->resumo;
        $categoria->cor = $request->conteudo;
        $categoria->categoria_id = $request->categoria_id;
        $categoria->usuario_id = Auth::user()->id;
            

        $categoria->save();

        return redirect()->route('admin.categorias.index');
    }

    public function destroy(string $id)
    {
        $categorias = Noticia::findorfail($id);
        $categorias->delete();
        return redirect()->route('admin.categorias.index');
    }

}



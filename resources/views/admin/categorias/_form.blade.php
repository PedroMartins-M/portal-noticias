@if($errors->any())
<div class="mb-6 text-red-500">
    <p class="font-semibold">Verifique os erros abaixo</p>
    <ul>
        @foreach ($errors->all() as $erro)

            <li>{{$erro}}</li>

        @endforeach

    </ul>
</div>
@endif

<div class="md-4">
    <label for="categoria_id" class="form-label"></label>
    <select name="categoria_id"  id="categoria_id" class="form-control">
        <option></option>
        
        @foreach ($categorias as $id => $nome)
            <option value="{{ $id }}" {{ old('categoria_id', 
            $noticia->categoria_id) == $id ? 'selected' : '' }}>{{ $nome }}</option>
        @endforeach
    </select>
</div>


<div class="md-4">
    <label for="descricao">Descrição *</label>
    <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao', $categorias->descricao) }}
    </textarea>
</div>

<div class="md-4">
    <label for="cor">Cor *</label>
    <textarea name="cor" id="cor" class="form-control" rows="10">{{ old('cor', $categorias->cor) }}</textarea>
</div>

<div class="md-4">
    <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-lg">Salvar</button>
    <a href={{route ('admin.noticias.index')}} class="bg-slate-200 text-slate-800 px-4 rounded-lg inline-block">Cancelar</a>
</div>

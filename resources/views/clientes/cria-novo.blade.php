@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @if(strtolower(Auth::user()->perfilUsuario->nome) == 'analista')
        @component('analista.barra-lateral')
        @endcomponent
    @endif

    @if(strtolower(Auth::user()->perfilUsuario->nome) == 'operador')
        @component('operador.barra-lateral')
        @endcomponent
    @endif


@endsection

@section('titulo-pagina', 'Cria novo cliente')

@section('conteudo-principal')

<form>
    <div class="row">
        <div class="col-md-8">
        <div class="form-group">
    <label>Nome</label>
    <input type="text" class="form-control" placeholder="Nome do cliente">

  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
        </div>
    </div>

 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



@endsection
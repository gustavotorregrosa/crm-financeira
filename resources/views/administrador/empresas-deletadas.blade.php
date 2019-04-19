@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Empresas deletadas')

@section('conteudo-principal')



<div class="table-responsive">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome interno</th>
      <th scope="col">CNPJ</th>
      <th scope="col">Cidade</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>

    @foreach($empresas as $empresa)    
    <tr>
      <td>{{$empresa->nomeinterno}}</td>
      <td>{{$empresa->cnpj}}</td>
      <td>{{$empresa->cidade}}</td>
      <td>
          <button data-id="{{$empresa->id}}" data-nome="{{$empresa->nomeinterno}}" class="btn-am-reativar btn btn-primary btn-sm">Reativar</button>
      </td>
    </tr>
    @endforeach


   
  </tbody>
</table>

</div>


<div id="mdl-reativa-empresa" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reativar empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
      <div class="modal-body">
          <input id="empresa-id" type="hidden">
        <p>Deseja reativar a empresa <span id="span-nome-empresa"></span>?</p>
      </div>
      <div class="modal-footer">
        <button id="btn-reativa-empresa" type="button" class="btn btn-primary">Reativar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>




@endsection


@section('js-adicionais')
    <script src="{{asset('custom-assets/administrador/empresas-deletadas.js')}}"></script>
@endsection
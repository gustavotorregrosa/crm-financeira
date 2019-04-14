@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Usuários deletados')

@section('conteudo-principal')



<div class="table-responsive">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Perfil</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>

    @foreach($usuarios as $usuario)    
    <tr>
      <td>{{$usuario->name}}</td>
      <td>{{$usuario->email}}</td>
      <td>{{$usuario->perfilUsuario->nome}}</td>
      <td>
          <button data-id="{{$usuario->id}}" data-nome="{{$usuario->name}}" class="btn-am-reativar btn btn-primary btn-sm">Reativar</button>
      </td>
    </tr>
    @endforeach


   
  </tbody>
</table>

</div>


<div id="mdl-reativa-user" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
      <div class="modal-body">
          <input id="user-id" type="hidden">
        <p>Deseja reativar o usuário <span id="span-nome-user"></span>?</p>
      </div>
      <div class="modal-footer">
        <button id="btn-reativa-user" type="button" class="btn btn-primary">Reativar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>




@endsection


@section('js-adicionais')
    <script src="{{asset('custom-assets/administrador/usuarios-deletados.js')}}"></script>
@endsection
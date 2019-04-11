@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Gestão de usuários')

@section('conteudo-principal')


<div>

<div class="table-responsive">
<table id="dt_usuarios" class="table table-borderless">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Perfil</th>
      <th scope="col">Supervisor</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  

  </tbody>
</table>
</div>
</div>




<div id="mdl-reativa-usuario" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reativar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja reativar o usuário <span id="spn-usr-reat"></span>?</p>
      </div>
      <div class="modal-footer">  
        <button id="btn-reat-usr" type="button" class="btn btn-primary">Reativar</button>
      </div>
    </div>
  </div>
</div>


<div id="mdl-inativa-usuario" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inativar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja inativar o usuário <span id="spn-usr-inat"></span>?</p>
      </div>
      <div class="modal-footer">  
        <button id="btn-inat-usr" type="button" class="btn btn-danger">Inativar</button>
      </div>
    </div>
  </div>
</div>


<div id="mdl-deleta-usuario" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deleta usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja deletar o usuário <span id="spn-usr-del"></span>?</p>
      </div>
      <div class="modal-footer">  
        <button id="btn-del-usr" type="button" class="btn btn-danger">Deletar</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js-adicionais')
<script src="{{asset('custom-assets/administrador/usuarios.js')}}"></script>
@endsection
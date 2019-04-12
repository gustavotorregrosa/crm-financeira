@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
@component('administrador.barra-lateral')

@endcomponent
@endsection

@section('titulo-pagina', 'Gestão de usuários')

@section('conteudo-principal')


<button id="btn-am-add-user" style="float: right;" class="btn btn-success btn-sm">Adicionar</button>

<br><br><br>


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




<div id="mdl-edita-usuario" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-editar-usuario" action="">
        <input type="hidden" id="usr-edit-id">
        <div class="modal-body">
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" id="user-nome-edit">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="user-email-edit">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control" id="user-senha-edit">
          </div>
          <div class="form-group">
            <input id="precisa-sup-edit" value="{{ $precisaSup }}" type="hidden">
            <label>Perfil</label>
            <select onchange="verificaPerfilEdit(this.value)" class="form-control" id="user-perfil-edit">
              <option value="" selected disabled>Escolha uma opção</option>
              @foreach($perfis as $perfil)
                <option value="{{$perfil->id}}">{{ ucfirst($perfil->nome) }}</option>
              @endforeach
            </select>
          </div>
          <div style="display:none;" id="grp-supervisor-edit" class="form-group">
            <label>Supervisor</label>
            <select class="form-control" id="user-supervisor-edit">
              <option value="" selected>Sem supervisor</option>
              @foreach($supervisores as $supervisor)
                <option value="{{$supervisor->id}}">{{ $supervisor->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="user-ativo-edit">
            <label class="form-check-label" for="user-ativo-edit">Ativo</label>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn-edita-usr" type="button" class="btn btn-success">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>




<div id="mdl-cria-usuario" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-criar-usuario" action="">
        <div class="modal-body">
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" id="user-nome">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="user-email">
          </div>
          <div class="form-group">
            <label>Senha</label>
            <input type="password" class="form-control" id="user-senha">
          </div>
          <div class="form-group">
            <input id="precisa-sup" value="{{ $precisaSup }}" type="hidden">
            <label>Perfil</label>
            <select onchange="verificaPerfil(this.value)" class="form-control" id="user-perfil">
              <option value="" selected disabled>Escolha uma opção</option>
              @foreach($perfis as $perfil)
                <option value="{{$perfil->id}}">{{ ucfirst($perfil->nome) }}</option>
              @endforeach
            </select>
          </div>
          <div style="display:none;" id="grp-supervisor" class="form-group">
            <label>Supervisor</label>
            <select class="form-control" id="user-supervisor">
              <option value="" selected disabled>Escolha um supervisor</option>
              @foreach($supervisores as $supervisor)
                <option value="{{$supervisor->id}}">{{ $supervisor->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="user-ativo">
            <label class="form-check-label" for="user-ativo">Ativo</label>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn-criar-usr" type="button" class="btn btn-success">Criar</button>
        </div>
      </form>
    </div>
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
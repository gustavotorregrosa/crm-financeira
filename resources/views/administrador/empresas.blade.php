@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Empresas')

@section('conteudo-principal')


<button id="btn-am-add-empresa" style="float: right;" class="btn btn-success btn-sm">Adicionar</button>

<br><br><br>



<div>

  <div class="table-responsive">
    <table id="dt_empresas" class="table table-borderless">
      <thead>
        <tr>
          <th scope="col">Nome Interno</th>
          <th scope="col">Nome Fantasia</th>
          <th scope="col">Cidade</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>


      </tbody>
    </table>
  </div>
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
      <div class="modal-body">
        <p>Deseja reativar a empresa <span id="spn-empr-reat"></span>?</p>
      </div>
      <div class="modal-footer">
        <button id="btn-reat-empresa" type="button" class="btn btn-primary">Reativar</button>
      </div>
    </div>
  </div>
</div>



<div id="mdl-inativa-empresa" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Inativar empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja inativara empresa <span id="spn-empr-inat"></span>?</p>
      </div>
      <div class="modal-footer">
        <button id="btn-inat-empr" type="button" class="btn btn-danger">Inativar</button>
      </div>
    </div>
  </div>
</div>


<div id="mdl-cria-empresa" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-criar-empresa" action="">
        <div class="modal-body">
          <div class="form-group">
            <label>Nome Interno</label>
            <input type="text" class="form-control" id="empresa-nomeinterno">
          </div>
          <div class="form-group">
            <label>Nome Fantasia</label>
            <input type="text" class="form-control" id="empresa-nomefantasia">
          </div>
          <div class="form-group">
            <label>Razão Social</label>
            <input type="text" class="form-control" id="empresa-razaosocial">
          </div>
          <div class="form-group">
            <label>CNJP</label>
            <input type="text" class="form-control cnpj" id="empresa-cnpj">
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <input type="text" class="form-control" id="empresa-cidade">
          </div>
  
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="empresa-ativa">
            <label class="form-check-label" for="empresa-ativa">Ativa</label>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn-criar-empr" type="button" class="btn btn-success">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div id="mdl-edita-empresa" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edita empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-edita-empresa" action="">
      <input type="hidden" class="form-control" id="empresa-id-edit">
        <div class="modal-body">empresa-id-edit
          <div class="form-group">
            <label>Nome Interno</label>
            <input type="text" class="form-control" id="empresa-nomeinterno-edit">
          </div>
          <div class="form-group">
            <label>Nome Fantasia</label>
            <input type="text" class="form-control" id="empresa-nomefantasia-edit">
          </div>
          <div class="form-group">
            <label>Razão Social</label>
            <input type="text" class="form-control" id="empresa-razaosocial-edit">
          </div>
          <div class="form-group">
            <label>CNJP</label>
            <input type="text" class="form-control cnpj" id="empresa-cnpj-edit">
          </div>
          <div class="form-group">
            <label>Cidade</label>
            <input type="text" class="form-control" id="empresa-cidade-edit">
          </div>
  
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="empresa-ativa-edit">
            <label class="form-check-label" for="empresa-ativa-edit">Ativa</label>
          </div>
        </div>
        <div class="modal-footer">
          <button id="btn-edit-empr" type="button" class="btn btn-success">Criar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="mdl-deleta-empresa" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deleta empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja deletar a empresa <span id="spn-empresa-del"></span>?</p>
      </div>
      <div class="modal-footer">
        <button id="btn-del-empresa" type="button" class="btn btn-danger">Deletar</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('js-adicionais')
  <script src="{{asset('custom-assets/administrador/jquery.mask.js')}}"></script>
  <script src="{{asset('custom-assets/administrador/empresas.js')}}"></script>
@endsection
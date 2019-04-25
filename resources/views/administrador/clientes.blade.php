@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
@component('administrador.barra-lateral')

@endcomponent
@endsection

@section('titulo-pagina', 'Clientes')

@section('conteudo-principal')


<button id="btn-am-add-cliente" style="float: right;" class="btn btn-success btn-sm">Adicionar</button>

<br><br><br>

<div>

  <div class="table-responsive">
    <table id="dt_clientes" class="table table-borderless">
      <thead>
        <tr>
          <th scope="col">Nome</th>
          <th scope="col">Empresa</th>
          <th scope="col">UF</th>
          <th scope="col">Cidade</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>


      </tbody>
    </table>
  </div>
</div>




<div id="mdl-edita-cliente" class="fade modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-edita-cliente">
      <input type="hidden" id="id-edita-cliente">
        <div class="modal-body">
          <div class="form-group">
            <label for="nome-edita-cliente">Nome</label>
            <input type="text" class="form-control" id="nome-edita-cliente">
          </div>
          <div class="form-group">
            <label for="cpf-edita-cliente">CPF</label>
            <input type="text" class="form-control cpf" id="cpf-edita-cliente">
          </div>
          <div class="form-group">
            <label>Empresa</label>
            <select class="form-control" id="empresa-edita-cliente">
              <option value="" selected disabled>Escolha uma empresa</option>
              @foreach($empresas as $empresa)
              <option value="{{$empresa->id}}">{{ $empresa->nomeinterno }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="orgao-edita-cliente">Órgão</label>
            <input type="text" class="form-control" id="orgao-edita-cliente">
          </div>
          <div class="form-group">
            <label for="beneficio-edita-cliente">Benefício</label>
            <input type="text" class="form-control" id="beneficio-edita-cliente">
          </div>
          <div class="form-group">
            <label for="salario-edita-cliente">Salário (R$)</label>
            <input type="text" class="form-control dinheiro" id="salario-edita-cliente">
          </div>
          <div class="form-group">
            <label for="uf-edita-cliente">UF</label>
            <select class="form-control" id="uf-edita-cliente"></select>
          </div>
          <div class="form-group">
            <label for="cidade-edita-cliente">Cidade</label>
            <select class="form-control" id="cidade-edita-cliente">
              <option value="" selected disabled>Escolha uma cidade</option>
            </select>
          </div>

          <div class="form-group">
            <label for="contatos-edita-cliente">Contatos</label>
            <div class="form-control" style="min-height: 5em;">
              <div class="row">
                <div class="col-8">
                  <div id="quadro-edita-contatos"></div>
                </div>
                <div class="col-4">
                  <button id="add-edita-contato" style="float: right;" class="btn btn-primary btn-sm">Novo contato</button>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button id="btn-edita-cliente" type="button" class="btn btn-primary">Salvar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>




<div id="mdl-add-cliente" class="fade modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-add-cliente">
        <div class="modal-body">
          <div class="form-group">
            <label for="nome-cliente">Nome</label>
            <input type="text" class="form-control" id="nome-cliente">
          </div>
          <div class="form-group">
            <label for="cpf-cliente">CPF</label>
            <input type="text" class="form-control cpf" id="cpf-cliente">
          </div>
          <div class="form-group">
            <label>Empresa</label>
            <select class="form-control" id="empresa-cliente">
              <option value="" selected disabled>Escolha uma empresa</option>
              @foreach($empresas as $empresa)
              <option value="{{$empresa->id}}">{{ $empresa->nomeinterno }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="orgao-cliente">Órgão</label>
            <input type="text" class="form-control" id="orgao-cliente">
          </div>
          <div class="form-group">
            <label for="beneficio-cliente">Benefício</label>
            <input type="text" class="form-control" id="beneficio-cliente">
          </div>
          <div class="form-group">
            <label for="salario-cliente">Salário (R$)</label>
            <input type="text" class="form-control dinheiro" id="salario-cliente">
          </div>
          <div class="form-group">
            <label for="uf-cliente">UF</label>
            <select class="form-control" id="uf-cliente"></select>
          </div>
          <div class="form-group">
            <label for="cidade-cliente">Cidade</label>
            <select class="form-control" id="cidade-cliente">
              <option value="" selected disabled>Escolha uma cidade</option>
            </select>
          </div>

          <div class="form-group">
            <label for="contatos-cliente">Contatos</label>
            <div class="form-control" style="min-height: 5em;">
              <div class="row">
                <div class="col-8">
                  <div id="quadro-contatos"></div>
                </div>
                <div class="col-4">
                  <button id="add-contato" style="float: right;" class="btn btn-primary btn-sm">Novo contato</button>
                </div>

              </div>
            </div>
          </div>
        </div>


        <div class="modal-footer">
          <button id="btn-add-cliente" type="button" class="btn btn-primary">Salvar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection



@section('js-adicionais')
<script src="{{asset('custom-assets/administrador/jquery.mask.js')}}"></script>
<script src="{{asset('custom-assets/administrador/clientes.js')}}"></script>
@endsection
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





<div id="mdl-add-cliente" class="fade modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
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
            <select class="form-control" id="cidade-cliente"></select>
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
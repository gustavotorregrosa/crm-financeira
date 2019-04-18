@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Empresas')

@section('conteudo-principal')


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


@endsection

@section('js-adicionais')
  <script src="{{asset('custom-assets/administrador/empresas.js')}}"></script>
@endsection
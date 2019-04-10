@extends('layout-geral.layout')

@section('titulo', 'Painel Admin')

@section('barra-lateral')
    @component('administrador.barra-lateral')

    @endcomponent
@endsection

@section('titulo-pagina', 'Gestão de usuários')

@section('conteudo-principal')
{{$usuarios}}
@endsection
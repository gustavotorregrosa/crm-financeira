<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function criaNovo(){
        $this->middleware('auth');
        $this->middleware('verificaperfil:analista,operador');
        return view('clientes.cria-novo');
    }

    public function criar(Request $request){
        $this->middleware('auth');
        // $this->middleware('verificaperfil:analista,operador');
        // \Log::debug(\Auth::user());
        $clienteNovo = new \App\Cliente;
        $clienteNovo->nome = $request->input('nome');
        $clienteNovo->cpf = $request->input('cpf');
        $clienteNovo->empresa = null;
        if(strtolower(\Auth::user()->perfilUsuario->nome) == 'administrador'){
            $clienteNovo->empresa = $request->input('empresa');
        }else{
            $clienteNovo->empresa = \Auth::user()->empresa;
        }
        $clienteNovo->orgao = $request->input('orgao');
        $clienteNovo->beneficio = $request->input('beneficio');
        $clienteNovo->salario = $request->input('salario');
        

        $clienteNovo->saveDD();

       
        
    }


    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

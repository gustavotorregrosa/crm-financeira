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



    public function ajaxClientes(){
        
        $clientes = \App\Cliente::all();
        $dados['data'] = $clientes;
        return json_encode($dados);
    }

    // public function criaNovo(){
    //     $this->middleware('auth');
    //     $this->middleware('verificaperfil:analista,operador');
    //     return view('clientes.cria-novo');
    // }

    public function modificar(Request $request){
        $this->middleware('auth');
        $cliente = \App\Cliente::find($request->input('id'));
        $usuario = \Auth::user();
        $isAutorizado = false;
        if((strtolower($usuario->perfilUsuario->nome) == "administrador") || ($cliente->empresa == $usuario->empresa)){
            $isAutorizado = true;
        }
        $cliente->nome = $request->input('nome');
        $cliente->cpf = $request->input('cpf');
        if(strtolower(\Auth::user()->perfilUsuario->nome) == 'administrador'){
            $cliente->empresa = $request->input('empresa');
        }
        $cliente->orgao = $request->input('orgao');
        $cliente->beneficio = $request->input('beneficio');
        $cliente->salario = $request->input('salario');
        $cliente->uf = $request->input('uf');
        $cliente->cidade = $request->input('cidade');
        $cliente->saveDD();
        $contatos = $request->input('contatos');




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
        $clienteNovo->uf = $request->input('uf');
        $clienteNovo->cidade = $request->input('cidade');
        $clienteNovo->saveDD();
        $contatos = $request->input('contatos');
        foreach($contatos as $contato){
            \App\Contato::create([
                'tipo' => $contato['tipo'],
                'telefone' => $contato['numero'],
                'cliente' => $clienteNovo->id
            ]);
        }

       
        
    }


    public function teste(){
        $cliente = \App\Cliente::find(1);
        dd($cliente);
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

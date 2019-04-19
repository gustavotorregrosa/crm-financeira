<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verificaperfil:administrador');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function reativaEmpresaDeletada(Request $request){
        $id = $request->input('id');

        $restauracao = \App\Empresa::withTrashed()
        ->where('id', $id)
        ->restore();

        if($restauracao){
            return "OK";
        }

        return false;

    }




    public function editaEmpresa(Request $request){
        
        $empresa = \App\Empresa::find($request->input('id'));
        $empresa->nomeinterno = $request->input('nomeinterno');
        $empresa->nomefantasia = $request->input('nomefantasia');
        $empresa->razaosocial = $request->input('razaosocial');
        $empresa->cnpj = $request->input('cnpj');
        $empresa->cidade = $request->input('cidade');
        $empresa->ativa = null;

        if($request->input('ativa') == true){
            $empresa->ativa = "1";
        }


        if($empresa->save()){
            return "OK";
        }

        return false;


        


    }

    public function criaEmpresa(Request $request){
        
        $novaEmpresa = new \App\Empresa;
        $novaEmpresa->nomeinterno = $request->input('nomeinterno');
        $novaEmpresa->nomefantasia = $request->input('nomefantasia');
        $novaEmpresa->razaosocial = $request->input('razaosocial');
        $novaEmpresa->cnpj = $request->input('cnpj');
        $novaEmpresa->cidade = $request->input('cidade');
     

        if($request->input('ativa') == true){
            $novaEmpresa->ativa = "1";
        }


        if($novaEmpresa->save()){
            return "OK";
        }

        return false;


        


    }

    public function inativaEmpresa(Request $request){
        $id = $request->input('id');
        $empresa = \App\Empresa::find($id);
        $empresa->ativa = null;
        if($empresa->save()){
            return "OK";
        }

        return false;
       
    }


    public function ajaxEmpresas(){
        
        $empresas = \App\Empresa::all();
        $dados['data'] = $empresas;
        return json_encode($dados);
    }

    public function reativaEmpresa(Request $request){
        $id = $request->input('id');
        $empresa = \App\Empresa::find($id);
        $empresa->ativa = "1";
        if($empresa->save()){
            return "OK";
        }

        return false;
       
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

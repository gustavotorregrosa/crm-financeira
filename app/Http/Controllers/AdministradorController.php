<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministradorController extends Controller
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
        return view('administrador.index');
    }


    public function ajaxUsuarios(){
        
        $usuarios = \App\User::with(['supervisionados', 'supervisor'])->get();
        $dados['data'] = $usuarios;
        return json_encode($dados);
    }


    public function retSupervisores(){
        $supervisores =  \App\User::whereHas('perfilUsuario', function($query){
            $query->where('nome', 'Supervisor');
        })->get();
        return json_encode($supervisores);


    }



    public function usuarios(){
        $perfisTemp = \App\Perfil::all();
        $perfis = [];
        $necessitaSupervisor = [
            'operador',
            'analista'
        ];
        $necessitaSupervisorNum = [];
        foreach($perfisTemp as $perfil){     
            $perfil->necessitaSup = false;       
            if(in_array(strtolower($perfil->nome), $necessitaSupervisor)){
                $perfil->necessitaSup = true;
                $necessitaSupervisorNum[] = $perfil->id;
            }
            $perfis[] = $perfil;
        }

        $necessitaSupervisorNum = implode(",", $necessitaSupervisorNum);
        
        $dados = [
            'perfis' => $perfis,
            'supervisores' => \App\User::whereHas('perfilUsuario', function($query){
                $query->where('nome', 'Supervisor');
            })->get(),
            'precisaSup' => $necessitaSupervisorNum
          
        ];

        
        return view('administrador.usuarios', $dados);
    }


    public function deletaUsuario(Request $request){
        $id = $request->input('id');
        return \App\User::destroy($id);
    }

    public function inativaUsuario(Request $request){
        $id = $request->input('id');
        $usuario = \App\User::find($id);
        $usuario->active = "0";
        if($usuario->save()){
            return "OK";
        }

        return false;
       
    }


    public function reativaUsuario(Request $request){
        $id = $request->input('id');
        $usuario = \App\User::find($id);
        $usuario->active = "1";
        if($usuario->save()){
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

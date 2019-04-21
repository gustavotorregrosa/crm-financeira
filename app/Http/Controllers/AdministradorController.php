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


    public function clientes()
    {
        
        $empresas =  \App\Empresa::where('ativa', true)->get();
        $dados = [
            'empresas' => $empresas
        ];
        return view('administrador.clientes', $dados);
    }


  


    public function empresas(){
        return view('administrador.empresas');
    }

    public function editaUsuario(Request $request){
        
        $usuario = \App\User::find($request->input('id'));
        $usuario->name = $request->input('nome');
        $usuario->email = $request->input('email');
        $usuario->empresa = $request->input('empresa');
        if($request->input('senha') != ""){
            $usuario->password = \bcrypt($request->input('senha'));
        }
        
        $usuario->active = null;
        if($request->input('ativo') == true){

            $usuario->active = "1";
        }

        $usuario->perfil = $request->input('perfil');
        $usuario->supervisor = $request->input('supervisor');


        if($usuario->save()){
            return "OK";
        }

        return false;


        


    }


    public function criaUsuario(Request $request){
        
        $novoUsuario = new \App\User;
        $novoUsuario->name = $request->input('nome');
        $novoUsuario->email = $request->input('email');
        $novoUsuario->password = \bcrypt($request->input('senha'));
        // $novoUsuario->active = 0;

        if($request->input('empresa')){
            $novoUsuario->empresa = $request->input('empresa');
        }

        if($request->input('ativo') == true){
            $novoUsuario->active = "1";
        }

        $novoUsuario->perfil = $request->input('perfil');
        $novoUsuario->supervisor = $request->input('supervisor');


        if($novoUsuario->save()){
            return "OK";
        }

        return false;


        


    }


    public function reativaUsuarioDeletado(Request $request){
        $id = $request->input('id');

        $restauracao = \App\User::withTrashed()
        ->where('id', $id)
        ->restore();

        if($restauracao){
            return "OK";
        }

        return false;

    }

    

    public function ajaxUsuarios(){
        
        $usuariosTemp = \App\User::with(['supervisionados', 'supervisor', 'empresa'])->get();
        $usuarios = [];
        foreach($usuariosTemp as $usuario){
            $usuario->isempresacerta = true;
            if($usuario->supervisor){
                \Log::debug($usuario->empresa);
                $usuarioSupervisor = \App\User::find($usuario->supervisor);
                

                if( $usuarioSupervisor->empresa != $usuario->empresa){
                    // \Log::debug($usuario);
                    $usuario->isempresacerta = false;
                }
            }

            $usuarios[] = $usuario;
        }
        $dados['data'] = $usuarios;
        return json_encode($dados);
    }


    public function retSupervisores(Request $request){
        // $supervisores =  \App\User::whereHas('perfilUsuario', function($query){
        //     $query->where('nome', 'Supervisor');
        // })->get();
        $empresa = $request->input('empresa');
        $supervisores =  \App\User::whereHas('perfilUsuario', function($query){
            $query->where('nome', 'Supervisor');
        })->whereHas('empresa', function($query) use ($empresa){
            $query->where('id', $empresa);
        })->get();
        return json_encode($supervisores);


    }


    public function retSupervisoresAll(){
        $supervisores =  \App\User::whereHas('perfilUsuario', function($query){
            $query->where('nome', 'Supervisor');
        })->get();
  
        return json_encode($supervisores);


    }


    public function retEmpresas(){
        $empresas =  \App\Empresa::where('ativa', true)->get();
        return json_encode($empresas);


    }



    public function usuariosExluidos(){
        $usuarios = \App\User::onlyTrashed()->get();
        $dados = [
            'usuarios' => $usuarios
        ];

        return view('administrador.deletados', $dados);
        
    }



    public function empresasExcluidas(){
        $empresas = \App\Empresa::onlyTrashed()->get();
        $dados = [
            'empresas' => $empresas
        ];

        return view('administrador.empresas-deletadas', $dados);
        
    }


    public function usuarios(){
        $perfisTemp = \App\Perfil::all();
        $empresas = \App\Empresa::all();
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
            'precisaSup' => $necessitaSupervisorNum,
            'empresas' => $empresas
          
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
        $usuario->active = null;
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

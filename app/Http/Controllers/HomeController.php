<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = \Auth::user();
        $perfil = $usuario->perfilUsuario->nome;
        $novaurl = "";

        $permissoes = [
            'analista',
            'operador',
            'supervisor',
            'administrador'
        ];

        if(in_array($perfil, $permissoes)){
            $novaurl = $perfil;
        }else{
            \Session::put('erro', 'usuario sem perfil 2');
            $novaurl = 'mensagens';
        }

        
        return redirect('/'.$novaurl);
    }

    public function mensagens(){
        $dados = [
            'mensagens' =>  \Session::get('erro')
        ];
        \Session::flush('erro');
        return view('login.mensagens', $dados);
    }

}

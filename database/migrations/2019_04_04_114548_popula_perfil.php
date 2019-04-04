<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulaPerfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $perfil = new App\Perfil;
        $perfil->nome = 'Padrão';
        $perfil->save();

        // $perfis = [
        //     'Padrão',
        //     'Operador',
        //     'Supervisor',
        //     'Administrador'
        // ];

        // foreach($perfis as $nome){
        //     $perfil = new App\Perfil;
        //     $perfil->nome = $nome;
        //     $perfil->save();
        // }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

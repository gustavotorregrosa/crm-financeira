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
        App\Perfil::create(['nome' => 'Padrão']);
        App\Perfil::create(['nome' => 'Operador']);
        App\Perfil::create(['nome' => 'Supervisor']);
        App\Perfil::create(['nome' => 'Administrador']);
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

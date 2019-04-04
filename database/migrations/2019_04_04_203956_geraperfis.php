<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Geraperfis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     
        $perfis = [
            'Analista',
            'Operador',
            'Supervisor',
            'Administrador'
        ];

        foreach ($perfis as $perfil) {
            App\Perfil::create(['nome' => $perfil]);
        }

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

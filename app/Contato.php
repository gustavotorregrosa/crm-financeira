<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $table = "contato";
    protected $guarded = [];

    public function cliente(){
        return $this->belongsTo('App\Cliente', 'cliente');
    }

    
}

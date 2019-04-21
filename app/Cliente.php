<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    protected $table = 'cliente';

    function saveDD(){
        $this->ultimo = \Auth::user()->id;
        $this->save();
    }

    public function ultimo(){
        return $this->belongsTo('App\User', 'ultimo');
    }
}

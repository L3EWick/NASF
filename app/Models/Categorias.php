<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = "categorias";

    protected $fillable = [
        'categorias'
    ];
    
    public function form()
    {
        return $this->belongsToMany('App\Models\Form', 'formcat', 'form_id', 'categorias_id' );
    }

}

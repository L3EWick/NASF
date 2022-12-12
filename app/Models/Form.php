<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = "form";

    protected $fillable = [
        'unidade',
        'equipe',
        'acs',
        'usuario',
        'dn',
        'endereco',
        'telefone',
        'mv_solicitacao',
        'relacao_caso',
        'solicitacao_data',
        'usuario_id'
        
    ];

    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categorias', 'form_categorias', 'form_id', 'categorias_id' );
    }

}

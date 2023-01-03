<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    protected $table = "comentario";
    protected $fillable = [
        'form_id',
        'comentario',
        'avaliacao',
        'outros'
    ];

}

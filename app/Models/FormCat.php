<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormCat extends Model
{
    protected $table = "form_categorias";
    
    protected $fillable = [
        'form_id',
        'categorias_id'
    ];

   
}


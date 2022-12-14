<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormCat;
use App\Models\Categorias;
use Auth;


class SolicitacoesController extends Controller
{
    public function create()
    {
        $solicitacao = Categorias::all();
        
        return view('solicitacoes.create',compact('solicitacao'));
    }
}

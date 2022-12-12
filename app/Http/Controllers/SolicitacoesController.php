<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitacoesController extends Controller
{
    public function index ()
    {
        return view('solicitacoes.index');
    }
}

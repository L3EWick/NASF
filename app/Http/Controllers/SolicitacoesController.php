<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormCat;
use App\Models\Categorias;
use App\Models\Comentarios;
use Auth;


class SolicitacoesController extends Controller
{
    public function solcreate($id)
    {
        $solicitacao = Form::with('categorias')->find($id);
        
        return view('solicitacoes.create',compact('solicitacao'));
    }
   

    public function update(Request $request, $id)
    {   
        
       
        $form = Form::with('categorias')->find($id);   
        $form->comentario           = $request->comentario;
        $form->avaliacao            = $request->avaliacao; 
        $form->outros               = $request->outros;
        $form->comentario_enviado   = '1';
        $form->data_coment    = date('Y/m/d');
        $form->nasf_id              = Auth::user()->id;
        $form->nasf_nome           = Auth::user()->name;
        
        $form->save();
        return redirect('/solicitacao');
    }

}

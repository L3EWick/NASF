<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormCat;
use App\Models\Categorias;
use Auth;

class SolicitacaoController extends Controller
{
    public function index ()
    {
        $usuariologado = Auth::user();
        // $solicitacao = Form::with('categorias')->get();
        
        if ($usuariologado->nivel == 'Medico') {
            $solicitacoes = Form::with('categorias')->where('usuario_id', '=', $usuariologado->id )->get();
        } else{
            $solicitacoes = Form::with('categorias')->where('enviado', 1)->get();
        }
        
        // dd($solicitacao)->all();
        return view('solicitacao.index', compact('solicitacoes'));
    }

    public function create()
    {
        $categorias = Categorias::all();
        return view('solicitacao.create',compact('categorias'));
    }
    
    public function store (Request $request)

    {

        $form = new Form;
        
        $form->usuario_id         = Auth::user()->id;
        $form->unidade         = $request->unidade;
        $form->equipe          = $request->equipe;
        $form->acs             = $request->acs;
        $form->usuario         = $request->usuario;
        $form->dn              = $request->dn;
        $form->endereco        = $request->endereco;
        $form->telefone        = $request->telefone;
        $form->mv_solicitacao  = $request->mv_solicitacao;
        $form->relacao_caso    = $request->relacao_caso;
        
        $form->save();

        $array_bugado = $request->categoria_id;
        


        if($request->categoria_id != null){
            foreach($array_bugado as $desbuga)
            {   
                $categoria = new FormCat;

                $categoria->categorias_id = $desbuga;
                $categoria->form_id = $form->id;

                $categoria->save();
            }
        }
        

        // if($request->categoria_id != null){
        //     foreach($request->categoria_id as $categoria)
        //     {
        //         $categoria = new FormCat;
                
        //         $categoria->categorias_id = '1';
        //         // dd($categoria);
               
        //         $categoria->form_id       = $form->id;
        //         $categoria->save();
        //     }
        // }


        return redirect('/solicitacao');
    }


    public function show($id)
    {
        $solicitacao = Form::with('categorias')->find($id);
       
        
        return view('solicitacao.show', compact('solicitacao'));
       


    }

    public function edit($id){
        $categorias = Categorias::all();

        $solicitacao = Form::with('categorias')->find($id);
        if ($solicitacao->enviado == 1) {
            return back()->withErrors('Nem tenta');
        } else {
             return view('solicitacao.edit', compact('solicitacao','categorias'));
        }
        
       
    }
    public function update(Request $request, $id){
    
        $form = Form::with('categorias')->find($id);   
       
        $form->unidade         = $request->unidade;
        $form->equipe          = $request->equipe;
        $form->acs             = $request->acs;
        $form->usuario         = $request->usuario;
        $form->dn              = $request->dn;
        $form->endereco        = $request->endereco;
        $form->telefone        = $request->telefone;
        $form->mv_solicitacao  = $request->mv_solicitacao;
        $form->relacao_caso    = $request->relacao_caso;
       
        $form->fill($request->all());
        $form->save(); 

        // $array_bugado = $request->categoria_id;
        // if($request->categoria_id != null){
        // foreach($array_bugado as $desbuga)
        // {   
        //     $categoria = FormCat::find($id);

        //     $categoria->categorias_id = $desbuga;
        //     $categoria->form_id = $form->id;

        //     $categoria->save();
        // }
        // }
       
       $arr_cat = $request->categorias_id;
       $form->categorias()->sync($arr_cat);

        return redirect()->route('solicitacao.index');

    }

    public function send($id){

        $send = Form::find($id);

        $send->enviado = '1';

        $send->save();
        
        return redirect()->route('solicitacao.index');
    }
}
